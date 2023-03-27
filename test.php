 <?php 
             $servername = "localhost";
            $username = "smilez";
            $password = "smilez@2022";
            $dbname = "smilez";

$conn = new mysqli($servername, $username, $password, $dbname);
    
    $datas = [];
    // iteration 1
  $sql = "SELECT DISTINCT patient_base_id, centre_id, patient_id
                FROM patient
                     
               WHERE centre_id =7 ORDER BY patient_base_id DESC LIMIT 20";
 // yuvaraj add
	  $result = $conn->query($sql);
	  
	  if ($result->num_rows > 0) {
	  while($row = $result->fetch_assoc()) {
	      
	      $pat_id = $row['patient_id'];
	      $cent_id = $row['centre_id'];
	      $pb_id = $row['patient_base_id'];
	      
	   //   echo $pat_id.'<br>';
	   
	   //itearation2
	   
	    $sql2 = "SELECT DISTINCT title,first_name,surname,phone_prefix,contact,email FROM 
                    patient_base
                    WHERE patient_base_id ='$pb_id'  ";
            // yuvaraj add
              $result2 = $conn->query($sql2);
              
              if ($result2->num_rows > 0) {
              while($row2 = $result2->fetch_assoc()) {
            
            $first_name = $row2['first_name'];
            
            // echo $first_name.'<br>';
            
            //iteration3
            
             $sql3 = "SELECT DISTINCT record_id FROM 
                        clinical_rec
                        WHERE patient_id = '$pat_id' AND centre_id = '$cent_id' ";
                        // yuvaraj add
                          $result3 = $conn->query($sql3);
                          
                          if ($result3->num_rows > 0) {
                          while($row3 = $result3->fetch_assoc()) {
                        $rec_id = $row3['record_id'];
                        
                        // echo $rec_id.'<br>';
                        
                        //iteration4
            $sql4 = "SELECT DISTINCT record_id, MAX(record_det_date) AS record_det_date FROM 
                                clinical_rec_details
                                WHERE record_id = '$rec_id' ";
                        // yuvaraj add
                          $result4 = $conn->query($sql4);
                          
                          if ($result4->num_rows > 0) {
                          while($row4 = $result4->fetch_assoc()) {
                        
                        $rec_idone = $row4['record_id'];
                        $rec_det_dateone = $row4['record_det_date'];
                        
                        // echo $rec_idone.'<br>';
                        // echo $rec_det_dateone.'<br>';
                        
                        //iteration5
            $sql5 = "SELECT DISTINCT record_id, record_det_date , MAX(record_det_id) AS record_det_id FROM 
                            clinical_rec_details 
                            WHERE record_id = '$rec_id' AND record_det_date = '$rec_det_dateone' ";
                    // yuvaraj add
                      $result5 = $conn->query($sql5);
                      
                      if ($result5->num_rows > 0) {
                      while($row5 = $result5->fetch_assoc()) {
                    
                    $rec_idtwo = $row5['record_id'];
                    $rec_det_datetwo = $row5['record_det_date'];
                    $rec_det_idone = $row5['record_det_id'];
                    
                    // echo $rec_det_idone.'<br>';
                    
                    //iteartion6
            $sql6 = "SELECT DISTINCT record_det_date, doc_id ,record_det_id FROM 
                            clinical_rec_details 
                            WHERE record_id = '$rec_id' AND record_det_date = '$rec_det_dateone' AND record_det_id = '$rec_det_idone' ";
                    // yuvaraj add
                      $result6 = $conn->query($sql6);
                      
                      if ($result6->num_rows > 0) {
                      while($row6 = $result6->fetch_assoc()) {
                            
                            $rec_det_idtwo = $row6['rec_det_id'];
                            $doc_id = $row6['doc_id'];
                            
                            // echo $doc_id.'<br>';
                            
                            //iteration 7
                            
                              $sql7 = "SELECT DISTINCT CONCAT('Dr. ',doc_name) AS doc_name FROM doctor WHERE doc_id = '$doc_id' ";
                                                            // yuvaraj add
                                                              $result7 = $conn->query($sql7);
                                                              
                                                              if ($result7->num_rows > 0) {
                                                              while($row7 = $result7->fetch_assoc()) {
                                                                
                                                                $doc_name = $row7['doc_name'];
                                                                // echo $doc_name.'<br>';
                                                                  
                                                                  //iteration8
                                                                  $sql8 = "SELECT DISTINCT * FROM planned_treatment WHERE record_id = '$rec_id' AND is_confirmed = 'Y'
               ORDER BY '$rec_det_dateone', '$first_name' LIMIT 1";
                                                            // yuvaraj add
                                                              $result8 = $conn->query($sql8);
                                                              
                                                              if ($result8->num_rows > 0) {
                                                              while($row8 = $result8->fetch_assoc()) {
                                                                  
                                                                  $plan_no = $row8['plan_no'];
                                                                  
                                                                  echo $plan_no;
                                                                  
                                                                  $row = $row+$row1+$row2+$row3+$row4+$row5+$row6+$row7+$row8;
                        	                                        array_push($datas,$row);
                                                              }
                                                              }
                                                                  
                                                                  //iteration8
                                                              }
                                                              }
                            
                            
                            //iteration7
                      }
                      }
                    
                    //iteration6
                    
                      }
                      }
                        
                        //iteration5
                          }
                          }
            
                        //iteration4
            
                          }
                          }
            //iteration3
            
            
              }
              }
	   //iteration2
	      
	      
	  }
	  print_r($datas);



	  } else {
	  print_r("no 0 results") ;
	  }
        //iteration1
         ?>