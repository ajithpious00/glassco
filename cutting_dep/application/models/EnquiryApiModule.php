<?php
class EnquiryApiModule extends CI_Model
{
    public function getedge()
    {
        return $this->db->select('ID AS id,Edge_type AS name')
            ->get('glass_edges')
            ->result();
    }
    public function getproduct()
    {
        return $this->db->select('ID AS id,Name AS name')
            ->get('tbl_product')
            ->result();
    }
    public function getproductUnit()
    {
        return $this->db->select('UN_Id AS id,UN_Name AS name')
            ->get('tbl_product_units')
            ->result();
    }
    public function getadditionalData()
    {
        return $this->db->select('AU_Id AS id,AU_Item AS itemname')
            ->get('tbl_additional_details')
            ->result();
    }
    public function getOrders($cu_id, $user_id)
    {
        return $this->db->query("SELECT PD.Name AS product_name, SL.SP_Id AS id, SL.PD_Id AS product_id, SL.PD_Height AS height, SL.PD_Width AS width, SL.PD_Quantity AS quantity, SL.PD_Unit AS unit, SL.PD_Waste AS wastage, SL.ED_Id AS edge, EG.Edge_type AS edgeName,PU.UN_Name AS unitName FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN glass_edges AS EG ON SL.ED_Id = EG.ID LEFT JOIN tbl_product_units AS PU ON SL.PD_Unit = PU.UN_Id WHERE SL.CU_Id = '" . $cu_id . "' AND SL.US_Id = '" . $user_id . "'")->result();
    }
    public function getcustomer($user_id, $status, $page, $limit)
    {
        $offset = ($page - 1) * $limit;
        if ($status == '0') {
            return $this->db->query("SELECT PD.Name, SL.SP_Id, SL.PD_Id, SL.PD_Height,SL.PD_Order_No, SL.PD_Width, SL.PD_Quantity, SL.PD_Unit, SL.ED_Id, SL.PD_Delivery_Date, SL.AdditionalDetails, SL.PD_Status, CU.CU_Name, CU.CU_Id, CU.CU_Name, CU.CU_Phone, CU.CU_Address, CU.CU_Gst_No, IV.IN_Invoice_Html FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN tbl_pr_invoice AS IV ON SL.CU_Id = IV.CU_Id WHERE  SL.US_Id = '" . $user_id . "' GROUP BY CU.CU_Id DESC LIMIT " . $offset . "," . $limit . "")->result();

        } else {
            return $this->db->query("SELECT PD.Name, SL.SP_Id, SL.PD_Id, SL.PD_Height,SL.PD_Order_No, SL.PD_Width, SL.PD_Quantity, SL.PD_Unit, SL.ED_Id, SL.PD_Delivery_Date, SL.AdditionalDetails, SL.PD_Status, CU.CU_Name, CU.CU_Id, CU.CU_Name, CU.CU_Phone, CU.CU_Address, CU.CU_Gst_No, IV.IN_Invoice_Html FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN tbl_pr_invoice AS IV ON SL.CU_Id = IV.CU_Id WHERE SL.PD_Status='" . $status . "' AND SL.US_Id = '" . $user_id . "' GROUP BY CU.CU_Id DESC LIMIT " . $offset . "," . $limit . "")->result();
        }
    }
    public function additionalData($us_id){
        return $this->db->select('AU_Id AS id, AU_Item AS itemname,AD_Quantity AS quantity,AD_Unit_Price AS price')
        ->where('CU_Id',$us_id)
        ->get('tbl_additional_addings')
        ->result();
    }
    public function updateEnquiry($cu_id, $user_id, $name, $address, $phone, $products, $deliveryDate, $additionalDetails, $gstNumber, $additionalDatas)
    {
        $date_time = date("Y-m-d H:i:s");
        $customer = array(
            'CU_Name' => $name,
            'CU_Phone' => $phone,
            'CU_Address' => $address,
            'CU_Created_at' => $date_time,
            'CU_Gst_No' => $gstNumber
        );
        $this->db->where('CU_Id', $cu_id)
            ->update('tbl_customer', $customer);
        foreach ($products as $key => $product) {
            $pdstatus = $product->status;
            $id = $product->id;
            if ($pdstatus == '6') {
                $result = $this->db->where('SP_Id', $id)
                    ->delete('tbl_sale_products');
            } elseif ($id == "") {
                $productdetails = array(
                    'PD_Id' => $product->product_id,
                    'PD_Height' => $product->height,
                    'PD_Width' => $product->width,
                    'PD_Quantity' => $product->quantity,
                    'PD_Waste' => $product->wastage,
                    'PD_Unit' => $product->unit,
                    'ED_Id' => $product->edge,
                    'CU_Id' => $cu_id,
                    'US_Id' => $user_id,
                    'PD_Delivery_Date' => $deliveryDate,
                    'AdditionalDetails' => $additionalDetails,
                    'PD_Order_No' => 'WO-' . $cu_id,
                    'PD_Order_Date' => $date_time,
                    'PD_Status' => 1
                );
                $result = $this->db->insert('tbl_sale_products', $productdetails);
            } else {
                $productdetails = array(
                    'PD_Id' => $product->product_id,
                    'PD_Height' => $product->height,
                    'PD_Width' => $product->width,
                    'PD_Waste' => $product->wastage,
                    'PD_Quantity' => $product->quantity,
                    'PD_Unit' => $product->unit,
                    'ED_Id' => $product->edge,
                );
                $result = $this->db->where('SP_Id', $id)
                    ->update('tbl_sale_products', $productdetails);
            }
        }
        foreach ($additionalDatas as $additionalData) {
            $ad_id = $additionalData->id;
            $additional = array(
                'AD_Quantity' => $additionalData->quantity,
                'AD_Unit_Price' => $additionalData->price
            );
            $this->db->where('AU_Id', $ad_id)
                ->where('CU_Id', $cu_id)
                ->update('tbl_additional_addings', $additional);
        }
        return $result;
    }
    public function updateSale($order_id, $status)
    {
        $data = [
            'PD_Status' => $status,
        ];
        return $this->db->where('PD_Order_No', $order_id)
            ->update('tbl_sale_products', $data);
    }
}