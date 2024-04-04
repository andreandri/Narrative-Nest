<?php 
 include("database.php");
 if(isset($_POST["input"])){
    $input = $_POST['input'];
    $query = "SELECT * FROM tb_novel WHERE judul_novel LIKE '$input%'";

    $result = mysqli_query($db, $query);

    if(mysqli_num_rows($result)> 0){
        
        while($row = mysqli_fetch_assoc($result)){
            $judul = $row['judul_novel'];
            
                    echo <<<HTML
                        <div class="produk-card">
                        <a href="detail_novel.php?id={$row['id_novel']}">
                        <img src="{$row['sampul_novel']}" style="width: 40%; height: 40%;"/>
                      <h3 class="produk-card-title">- {$row['judul_novel']} -</h3>
                    </a>
                    </div>
            HTML;
        } 
 }else{
    
 }
}
?>