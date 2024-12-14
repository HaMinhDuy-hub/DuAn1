<?php
   function loadall_danhmuc()
   {
       $sql = "SELECT * FROM categories WHERE deleted_at IS NULL ORDER BY id ASC";
       $listdanhmuc = pdo_query($sql);
       return $listdanhmuc;
   }

    function insert_danhmuc($tenloai){
        $sql="insert into categories(name) values('$tenloai')";
        pdo_execute($sql);
    }

    function delete_danhmuc(){
        $sql = "delete from categories where id=".$_GET['id'];
        pdo_execute($sql);
    }
 
    function loadone_danhmuc($id){
        $sql="select * from categories where id=".$id;
        $dm= pdo_query_one($sql);
        return $dm;
    }
    
    function update_danhmuc($id,$tenloai){
        $sql="update categories set name='".$tenloai."' where id =".$id;
        pdo_execute($sql);
    }

?>