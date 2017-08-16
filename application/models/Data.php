<?PHP

class Data extends CI_Model {

    function __construct () {
        parent::__construct ();
    }

    public function timeSlotFetch ($con,$course) {
          $stmt = $con->prepare("SELECT * FROM time_slots");
          $stmt->execute();
          $row=$stmt->fetchAll();
          $hint = NULL;
          if($stmt->rowCount()>0){
              $count = $stmt->rowCount();
              for($i=0;$i<$count;$i++){
                  $row_arr_com = $row[$i]['courses'];
                  $row_arr = explode(",",$row_arr_com);
                  $count_arr = sizeof($row_arr);
                  for($j=0; $j<$count_arr; $j++){
                      if($row_arr[$j] === $course){
                          if (!isset($hint)) {
                          $hint = "<option value='".$row[$i]["id"]."'>".$row[$i]["time_slots"]."</option>";
                          }
                          else {
                          $hint = $hint."<option value='".$row[$i]["id"]."'>".$row[$i]["time_slots"]."</option>";
                          }
                      }
                  }
              }
              if($hint !== ""){
                  return $hint;
              }
          }
      return $hint;
    }

  public function regFees($con){
    $stmt = $con->prepare("SELECT * FROM reg_fees");
    $stmt->execute();
    $row = $stmt->fetchAll();
    $reg_fees = $row[0]['price'];
    return $reg_fees;
  }

  public function feesDat($con,$table,$course){
    $stmt = $con->prepare("SELECT * FROM $table WHERE course=:course");
    $stmt->bindParam(":course", $course, PDO::PARAM_INT);
    $stmt->execute();

    $feesDat["fees_row"] = $stmt->fetchAll();
    $feesDat["fees_row_count"] = $stmt->rowCount();
    return $feesDat;
  }

  public function totalFees($con,$table,$course,$length,$reg_fees,$fees_row_count,$fees_row){
    //echo $fees_row_count;
        for($i = 0; $i < $fees_row_count; $i++){
            $length_arr = explode(",",$fees_row[$i]['length']);
            for($j = 0; $j < sizeof($length_arr); $j++){
                if($length_arr[$j] === $length){
                    $finalFees["fees"] = $fees_row[$i]['price'];
                    break;
                }
            }
        }
        $finalFees["total_fees"] = $finalFees["fees"]+$reg_fees;

        return $finalFees;
  }

  public function discountRate($con,$coupon_code,$total_fees){
      $today = date("Y-m-d");
      $this->db->select('*');
      $this->db->from('coupon');
      $array = array('code' => $coupon_code, 'status' => '1', 'start_date<=' => $today, 'end_date>=' => $today);
      $this->db->where($array);
      $query = $this->db->get ();
      $row = $query->row();

        if (isset($row)){
          $discountData['id'] = $row->id;
          $discountData['code'] = $row->code;
          $discountData['start_date'] = $row->start_date;
          $discountData['end_date'] = $row->end_date;
          $discountData['discount'] = $row->discount;
          $discountData['statusPromo'] = $row->status;
        }

        if (isset($discountData)){
          $coupon = $discountData['discount'];
          $discount["rate"] = ($total_fees * $coupon) / 100;
          $discount["status"] = "Promo Code applied and a discount of £".$discount["rate"]." available";
        }else{
          $discount["rate"] = 0;
          $discount["status"] = "Sorry! the Promo code you've entered is invalid";
        }
      return $discount;
  }

  public function getPromoListCount($filter = array()){
   $this->db->select ('COUNT(id) AS promoListCount');
     $this->db->from ('coupon');

     if (isset ($filter['groupByValue'])) {
         $this->db->select ('COUNT(id) AS promoListCount');
         $this->db->group_by ('id');
         $query = $this->db->get ();
         $countList = array();
         return $countList;
     }
     else {
         $query = $this->db->get ();
         $row   = $query->row ();
        //  log_message('info','getPromoList '.$this->db->last_query());
        //  log_message('info','$row->promoListCount '.$row->promoListCount);
         return $row->promoListCount;
     }
  }

  public function getPromoList ($filter = array()) {
     $result = array();
     $promoListData = array();
     $promoListDataList = array();

   $this->db->select('*');
     $this->db->from ('coupon');
     $start = 0;

     if (isset ($filter['length'])) {
       $this->db->limit ($filter['length'], $filter['start']);
       if (isset ($filter['length']))
         $start = $filter['start'];
     }

    //  if(isset($filter['search'])){
     //
    //    $searchArr = array();
    //    $searchArr['code'] = $filter['search'];
     //
    //    $where = $this->Init->generateSpecialCondition($searchArr);
    //    $this->db->where($where);
    //  }
     $query    = $this->db->get ();

         if ($query->num_rows() < 0){
     foreach ($query->result () as $user){
       $promoListData['id'] = "No Data";
       $promoListData['code'] = "No Data";
       $promoListData['start_date'] = "No Data";
       $promoListData['end_date'] = "No Data";
       $promoListData['statusPromo'] = "No Data";

       array_push ($promoListDataList, $promoListData);
   }
     return $promoListDataList;
   }else{
     $count = 0;
     foreach ($query->result () as $user){
       $promoListData['sl'] = ++$count;
       $promoListData['id'] = $user->id;
       $promoListData['code'] = $user->code;
       $promoListData['start_date'] = $user->start_date;
       $promoListData['end_date'] = $user->end_date;
       $promoListData['discount'] = $user->discount;
       $promoListData['statusPromo'] = $user->status;

       array_push ($promoListDataList, $promoListData);
     }
    //  log_message('info','getPromoList '.$this->db->last_query());
    //  log_message('info',print_r($promoListDataList,TRUE));
     return $promoListDataList;
   }
  }

public function promoStatusChangerDB ($promoID, $promoStatus) {
  $this->db->set('status', $promoStatus);
  $this->db->where('id', $promoID);
  $this->db->update('coupon');
  log_message('info','promoStatusChangerDB '.$this->db->last_query());
  return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
}

public function updatePromoDB ($promoID, $promoCode, $promoCodeStartDate, $promoCodeEndDate, $promoCodeDiscount, $promoStatusPromo) {

  $data = array(
        'code' => $promoCode,
        'start_date' => $promoCodeStartDate,
        'end_date' => $promoCodeEndDate,
        'discount' => $promoCodeDiscount,
        'status' => $promoStatusPromo
  );

  $this->db->where('id', $promoID);
  $this->db->update('coupon', $data);
  log_message('info','updatePromoDB '.$this->db->last_query());
  return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
}

public function promoCodeDeleteDB ($promoID){
  $this->db->where('id', $promoID);
  $this->db->delete('coupon');
  return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
}

public function saveBookDataDB ($bookData) {
  $data = array(
      'name' => $bookData['name'],
      'email' => $bookData['email'],
      'dob' => $bookData['dob'],
      'gender' => $bookData['gender'],
      'nationality' => $bookData['nationality'],
      'passportNationality' => $bookData['passportNationality'],
      'addressline1' => $bookData['addressline1'],
      'addressline2' => $bookData['addressline2'],
      'zipcode' => $bookData['zipcode'],
      'city' => $bookData['city'],
      'country' => $bookData['country'],
      'region' => $bookData['region']
  );
  // log_message('info',print_r($data,TRUE));
  $this->db->insert('booked', $data);
  return ($this->db->affected_rows() != 1) ? false : true;
  }

  public function getBookDataListCount($filter = array()){
   $this->db->select ('COUNT(bid) AS bookDataListCount');
     $this->db->from ('booked');

     if (isset ($filter['groupByValue'])) {
         $this->db->select ('COUNT(bid) AS bookDataListCount');
         $this->db->group_by ('bid');
         $query = $this->db->get ();
         $countList = array();
         return $countList;
     }
     else {
         $query = $this->db->get ();
         $row   = $query->row ();
        //  log_message('info','getPromoList '.$this->db->last_query());
        //  log_message('info','$row->promoListCount '.$row->promoListCount);
         return $row->bookDataListCount;
     }
  }

  public function getBookDataList ($filter = array()) {
     $result = array();
     $bookData = array();
     $bookDataList = array();

   $this->db->select('*');
     $this->db->from ('booked');
     $start = 0;

     if (isset ($filter['length'])) {
       $this->db->limit ($filter['length'], $filter['start']);
       if (isset ($filter['length']))
         $start = $filter['start'];
     }

     if(isset($filter['search'])){

       $searchArr = array();
       $searchArr['name'] = $filter['search'];

       $where = $this->Init->generateSpecialCondition($searchArr);

       $this->db->where($where);
     }
     $query    = $this->db->get ();

         if ($query->num_rows() < 0){
     foreach ($query->result () as $user){
       $bookData['bid'] = "No Data";
       $bookData['name'] = "No Data";
       $bookData['email'] = "No Data";
       $bookData['dob'] = "No Data";
       $bookData['gender'] = "No Data";
       $bookData['nationality'] = "No Data";
       $bookData['passportNationality'] = "No Data";
       $bookData['addressline1'] = "No Data";
       $bookData['addressline2'] = "No Data";
       $bookData['zipcode'] = "No Data";
       $bookData['city'] = "No Data";
       $bookData['country'] = "No Data";
       $bookData['region'] = "No Data";
       $bookData['bookingStatus'] = "No Data";

       array_push ($bookDataList, $bookData);
   }
     return $bookDataList;
   }else{
     $count = 0;
     foreach ($query->result () as $user){
       $bookData['sl'] = ++$count;
       $bookData['bid'] = $user->bid;
       $bookData['name'] = $user->name;
       $bookData['email'] = $user->email;
       $bookData['dob'] = $user->dob;
       $bookData['gender'] = $user->gender;
       $bookData['nationality'] = $user->nationality;
       $bookData['passportNationality'] = $user->passportNationality;
       $bookData['addressline1'] = $user->addressline1;
       $bookData['addressline2'] = $user->addressline2;
       $bookData['zipcode'] = $user->zipcode;
       $bookData['city'] = $user->city;
       $bookData['country'] = $user->country;
       $bookData['region'] = $user->region;
       $bookData['bookingStatus'] = $user->bookingStatus;

       array_push ($bookDataList, $bookData);
     }
      // log_message('info','getPromoList '.$this->db->last_query());
    //  log_message('info',print_r($promoListDataList,TRUE));
     return $bookDataList;
   }
  }

  public function getSelectedBookDataList ($bookingID) {
     $result = array();
     $bookSelectedData = array();
     $bookSelectedDataList = array();

   $this->db->select('*');
     $this->db->from ('booked');
    $this->db->where('bid', $bookingID);
     $query    = $this->db->get ();

         if ($query->num_rows() < 0){
     foreach ($query->result () as $user){
       $bookSelectedData['bid'] = "No Data";
       $bookSelectedData['name'] = "No Data";
       $bookSelectedData['email'] = "No Data";
       $bookSelectedData['dob'] = "No Data";
       $bookSelectedData['gender'] = "No Data";
       $bookSelectedData['nationality'] = "No Data";
       $bookSelectedData['passportNationality'] = "No Data";
       $bookSelectedData['addressline1'] = "No Data";
       $bookSelectedData['addressline2'] = "No Data";
       $bookSelectedData['zipcode'] = "No Data";
       $bookSelectedData['city'] = "No Data";
       $bookSelectedData['country'] = "No Data";
       $bookSelectedData['region'] = "No Data";
       $bookSelectedData['bookingStatus'] = "No Data";

       array_push ($bookSelectedDataList, $bookSelectedData);
   }
     return $bookSelectedDataList;
   }else{
     $count = 0;
     foreach ($query->result () as $user){
       $bookSelectedData['sl'] = ++$count;
       $bookSelectedData['bid'] = $user->bid;
       $bookSelectedData['name'] = $user->name;
       $bookSelectedData['email'] = $user->email;
       $bookSelectedData['dob'] = $user->dob;
       $bookSelectedData['gender'] = $user->gender;
       $bookSelectedData['nationality'] = $user->nationality;
       $bookSelectedData['passportNationality'] = $user->passportNationality;
       $bookSelectedData['addressline1'] = $user->addressline1;
       $bookSelectedData['addressline2'] = $user->addressline2;
       $bookSelectedData['zipcode'] = $user->zipcode;
       $bookSelectedData['city'] = $user->city;
       $bookSelectedData['country'] = $user->country;
       $bookSelectedData['region'] = $user->region;
       $bookSelectedData['bookingStatus'] = $user->bookingStatus;

       array_push ($bookSelectedDataList, $bookSelectedData);
     }
      // log_message('info','getPromoList '.$this->db->last_query());
    //  log_message('info',print_r($promoListDataList,TRUE));
     return $bookSelectedDataList;
   }
  }

  public function bookingDeleteDB ($bookingID) {
    $this->db->where('bid', $bookingID);
    $this->db->delete('booked');
    return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

  public function exportCSV(){
     $sql = $this->db->get('booked');
     header('Content-Type: text/csv; charset=utf-8');
     header('Content-Disposition: attachment; filename=booking_data_'.date('Y-m-d-H:i:s').'.csv');
     $handle = fopen('php://output', 'w');
     fputcsv($handle, array('Name', 'Email','Date of birth','Gender', 'Nationality', 'passport Nationality', 'Address Line 1', 'Address Line 2', 'Zip Code', 'City', 'Country', 'Region', 'Booking Status'));

     foreach($sql->result() as $row)
     {
     fputcsv($handle, array(
    //  $row->bid,
     $row->name,
     $row->email,
     $row->dob,
     $row->gender,
     $row->nationality,
     $row->passportNationality,
     $row->addressline1,
     $row->addressline2,
     $row->zipcode,
     $row->city,
     $row->country,
     $row->region,
     $row->bookingStatus = ($row->bookingStatus == 1 ? 'Payment Sucessful' : 'Payment Pending'),
     ));
     }
     fputcsv($handle, array());
     fclose($handle);

     $headers = array(
     'Content-Type' => 'text/csv',
     );
  }

  public function getSelectedPromoList ($promoID) {
     $result = array();
     $promoSelectedListData = array();
     $promoSelectedListDataList = array();

   $this->db->select('*');
     $this->db->from ('coupon');
     $this->db->where('id', $promoID);
     $query    = $this->db->get ();

         if ($query->num_rows() < 0){
     foreach ($query->result () as $user){
       $promoSelectedListData['id'] = "No Data";
       $promoSelectedListData['code'] = "No Data";
       $promoSelectedListData['start_date'] = "No Data";
       $promoSelectedListData['end_date'] = "No Data";
       $promoSelectedListData['statusPromo'] = "No Data";

       array_push ($promoSelectedListDataList, $promoListData);
   }
     return $promoSelectedListDataList;
   }else{
     $count = 0;
     foreach ($query->result () as $user){
       $promoSelectedListData['sl'] = ++$count;
       $promoSelectedListData['id'] = $user->id;
       $promoSelectedListData['code'] = $user->code;
       $promoSelectedListData['start_date'] = $user->start_date;
       $promoSelectedListData['end_date'] = $user->end_date;
       $promoSelectedListData['discount'] = $user->discount;
       $promoSelectedListData['statusPromo'] = $user->status;

       array_push ($promoSelectedListDataList, $promoSelectedListData);
     }
    //  log_message('info','getSelectedPromoList '.$this->db->last_query());
    //  log_message('info',print_r($promoSelectedListDataList,TRUE));
     return $promoSelectedListDataList;
   }
  }

}
