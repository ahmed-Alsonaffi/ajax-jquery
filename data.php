<?php

    $host="localhost";
    $username="root";
    $password="";
    $databasename="ajax-jquery";

    $connect=new mysqli($host,$username,$password,$databasename);
    session_start();
    if(isset($_POST['readdata']))
    {
        if(isset($_POST['search']))
            $search=$_POST['search'];
        else
            $search='';

        $select_data=mysqli_query($connect,"SELECT * FROM `courses` where course_name like '%$search%'");
        while($row=mysqli_fetch_array($select_data)){

            $data='<!-- Table item -->
            <tr>
                <!-- Table data -->
                <td class="d-none">
                    <h6 class="course-title mt-2 mt-md-0 mb-0"><a href="#">
                    '.$row["id"].'</a></h6>
                </td>
                <!-- Table data -->
                <td>
                    <h6 class="course-title mt-2 mt-md-0 mb-0"><a href="#">
                    '.$row["course_name"].'</a></h6>
                </td>
                <!-- Table data -->
                <td>
                    <h6 class="mb-0"><a href="#">'.$row["course_price"].'</a></h6>
                </td>
                
                <!-- Table data -->
                <td>
                    <div class="d-flex gap-2">
                        <a href="#" onclick="deletecourse('.$row["id"].')" class="btn btn-light btn-round mb-0" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
                        <a href="#" onclick="editcourse('.$row["id"].',\''.$row["course_name"].'\','.$row["course_price"].')" class="btn btn-light btn-round mb-0"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i
                                class="fas fa-edit"></i></a>
                    </div>
                </td>
            </tr>';

            echo $data;
        }
    }


    if(isset($_POST['do_add']))
    {

        $name=$_POST["coursename"];
        $price=$_POST["courseprice"];
        
        $sql="insert into courses(course_name,course_price) values('$name',$price)";

        if(mysqli_query($connect,$sql))
            echo "success";
        else
            echo "error";

        exit();
    }

    if(isset($_POST['deletecourse']))
    {
        $no=$_POST['no'];
        $sql2="delete from courses where id=$no";
        mysqli_query($connect,$sql2);
    }

    if(isset($_POST['do_update'])){
        $no=$_POST["courseno"];
        $name=$_POST["coursename"];
        $price=$_POST["courseprice"];
        
        $sql="update courses set course_name='$name',course_price=$price where id=$no";

        if(mysqli_query($connect,$sql))
            echo "success";
        else
            echo "error";

        exit();
    }


    
?>
