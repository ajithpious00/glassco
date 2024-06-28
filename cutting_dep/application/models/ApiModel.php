<?php
class ApiModel extends CI_Model
{
    public function login($phone, $password)
    {
        $query = $this->db->query("SELECT US_Id,US_Name AS name,Email AS email ,Mobile AS phone,City AS area FROM `user` WHERE Usertype='5'  AND Mobile =" . $phone . " AND Password =md5('" . $password . "')");
        $user = $query->row();
        return $user;
    }
    public function getProfile($user_id)
    {
        return $this->db->query("SELECT US_Name AS name,Email AS email ,Mobile AS phone,City AS area FROM `user` WHERE Usertype='5'  AND US_Id =" . $user_id)->row();
    }
    public function updateProfile($user_id, $name, $email, $phone)
    {
        $data = array(
            'US_Name' => $name,
            'Email' => $email,
            'Mobile' => $phone
        );
        $result = $this->db->where('US_Id', $user_id)
            ->update('user', $data);
        return $result;
    }
    public function addEnquiry($user_id, $name, $address, $phone, $products, $deliveryDate, $additionalDetails, $additionalDatas, $gstNumber)
    {
        $date_time = date("Y-m-d H:i:s");
        $data = array(
            'CU_Name' => $name,
            'CU_Phone' => $phone,
            'CU_Address' => $address,
            'CU_Created_at' => $date_time,
            'CU_Gst_No' => $gstNumber
        );
        $this->db->insert('tbl_customer', $data);
        $id = $this->db->insert_id();
        foreach ($products as $product) {
            $productdetails = array(
                'PD_Id' => $product->product_id,
                'PD_Height' => $product->height,
                'PD_Width' => $product->width,
                'PD_Quantity' => $product->quantity,
                'PD_Unit' => $product->unit,
                'PD_Waste' => $product->wastage,
                'ED_Id' => $product->edge,
                'CU_Id' => $id,
                'US_Id' => $user_id,
                'PD_Delivery_Date' => $deliveryDate,
                'AdditionalDetails' => $additionalDetails,
                'PD_Order_No' => 'WO-' . $id,
                'PD_Order_Date' => $date_time,
                'PD_Status' => 1
            );
            $this->db->insert('tbl_sale_products', $productdetails);
        }
        foreach ($additionalDatas as $additionalData) {
            $additional= array(
                'AU_Id' => $additionalData->id,
                'AU_Item' => $additionalData->itemname,
                'AD_Quantity' => $additionalData->quantity,
                'AD_Unit_Price' => $additionalData->price,
                'CU_Id' => $id,
                'US_Id' => $user_id,
            );
            $result = $this->db->insert('tbl_additional_addings', $additional);
        }
        return $result;
    }
    public function uploadProfile($user_id, $file)
    {
        $result = $this->db->where('US_Id', $user_id)
            ->get('tbl_profile_image');
        if ($result->num_rows() > 0) {
            $data = array(
                'Image' => $file
            );
            return $this->db->where('US_Id', $user_id)
                ->update('tbl_profile_image', $data);
        } else {
            $data = array(
                'US_Id' => $user_id,
                'Image' => $file
            );
            return $this->db->insert('tbl_profile_image', $data);
        }
    }
}