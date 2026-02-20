<!-- @import jquery & sweet alert  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php 

    //Connection to DB
    function connection_db() {
        $con = new mysqli('','','','');
        return $con;
    }

    //Get website logo
    function get_website_logo($type) {
        $con = connection_db();
        $sql = " SELECT * FROM `tbl_website_logo` WHERE `type` = ? ";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $type);
        $stmt->execute();
        $rs = $stmt->get_result();
        $row = mysqli_fetch_assoc($rs);
        if ($row) {
            $thumbnail = 'admin/assets/image/'.$row['thumbnail'];
            return $thumbnail;
        }
        return '';
    }

    //Get Trending News
    function get_trending_news() {
        $con = connection_db();
        $sql = " SELECT * FROM `tbl_news`  ORDER BY id DESC LIMIT 3  ";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $rs = $stmt->get_result();
        while($row = mysqli_fetch_assoc($rs)) {
            echo '
                <i class="fas fa-angle-double-right"></i>
                <a href="news-detail.php?id='.$row['id'].'">'.$row['title'].' </a> &ensp;
            ';
        }

    }

    //Get News Detail
    function news_detail($id) {
        $con = connection_db();
        $sql = " SELECT * FROM `tbl_news` WHERE id = ? ";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $rs = $stmt->get_result();
        $row = mysqli_fetch_assoc($rs);

        if ($row) {
            $current_viewer = $row['viewer'];
            $total_viewer   = $current_viewer + 1;
            $sql_update = " UPDATE `tbl_news` SET viewer = ? WHERE id = ? ";
            $stmt_update = $con->prepare($sql_update);
            $stmt_update->bind_param("ii", $total_viewer, $id);
            $stmt_update->execute();

            echo '
            <div class="main-news">
                <div class="thumbnail" style="height: 450px; overflow: hidden;">
                    <img src="admin/assets/image/'.$row['thumbnail'].' "style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div class="detail">
                    <h3 class="title">'.substr($row['title'], 0, 75).'...</h3>
                    <div class="date">'.$row['created_at'].'</div>
                    <div class="description">'.$row['description'].'</div>
                </div>
            </div>
            ';
        }
    }

    //Realted News
    function related_news($detail_id) {

        $con = connection_db();
        $sql_detail = " SELECT * FROM `tbl_news` WHERE id = ? ";
        $stmt_detail = $con->prepare($sql_detail);
        $stmt_detail->bind_param("i", $detail_id);
        $stmt_detail->execute();
        $rs_detail = $stmt_detail->get_result();
        $row_detail = mysqli_fetch_assoc($rs_detail);
        
        if ($row_detail) {
            $news_type  = $row_detail['news_type'];

            //select relate news
            $sql = " SELECT * FROM `tbl_news` WHERE id NOT IN(?) AND news_type = ? ORDER BY id DESC LIMIT 2 ";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("is", $detail_id, $news_type);
            $stmt->execute();
            $rs = $stmt->get_result();
            if ($rs->num_rows === 0) {
                echo '<img src="https://placehold.co/300x200/png?text=No+Related+News" style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;">';
            } else {
                while( $row = mysqli_fetch_assoc($rs) ) {
    
                    echo '
                        <figure>
                            <a href="news-detail.php?id='.$row['id'].'" style="height: 100%;">
                                <div class="thumbnail" style="height: 200px; overflow: hidden;">
                                    <img src="admin/assets/image/'.$row['thumbnail'].'" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div class="detail">
                                    <h3 class="title">'.substr($row['title'], 0, 40).'...</h3>
                                    <div class="date">'.$row['created_at'].'</div>
                                    <div class="description" style="word-wrap: break-word; overflow-wrap: break-word;">'.$row['description'].'</div>
                                </div>
                            </a>
                        </figure>
                    ';
    
                }
            }
        }
    }

    //Popular News
    function main_popular_news() {
        $con = connection_db();
        $sql = " SELECT * FROM `tbl_news` ORDER BY `viewer` DESC LIMIT 1 ";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $rs = $stmt->get_result();
        $row = mysqli_fetch_assoc($rs);
        if (!$row) {
            echo '<img src="https://placehold.co/700x400/png" width="100%">';
            return;
        }

        echo '
            <figure>
                <a href="news-detail.php?id='.$row['id'].'" style="display: block; height: 100%;">
                    <div class="thumbnail" style="height: 515px; overflow: hidden; position: relative;">
                        <img src="admin/assets/image/'.$row['thumbnail'].'" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                        <div class="title" style="width: 100%;">'.substr($row['title'], 0, 45).'...</div>
                    </div>
                </a>
            </figure>
        ';

    }

    function sub_main_popular_news() {
        $con = connection_db();
        $sql = " SELECT * FROM `tbl_news` WHERE id != (SELECT id FROM tbl_news ORDER BY viewer DESC LIMIT 1) ORDER BY `viewer` DESC LIMIT 2 ";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $rs = $stmt->get_result();
        if ($rs->num_rows == 0) {
            echo '<img src="https://placehold.co/350x200/png" width="100%">';
            return;
        }
        while($row = mysqli_fetch_assoc($rs)) {
            echo '
                <div class="col-12">
                    <figure>
                        <a href="news-detail.php?id='.$row['id'].'" style="display: block; height: 100%;">
                            <div class="thumbnail" style="height: 250px; overflow: hidden; position: relative;">
                                <img src="admin/assets/image/'.$row['thumbnail'].'" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                <div class="title" style="width: 100%;">'.substr($row['title'], 0, 45).'...</div>
                            </div>
                        </a>
                    </figure>
                </div>
            ';
        }
    }

    //Get latest news on homepage
    function get_latest_news($news_type) {
        $con = connection_db();
        
        // Set limit to 6 for sport and social, otherwise default to 3 (e.g. for entertainment)
        $limit = ($news_type == 'sport' || $news_type == 'social'  || $news_type == 'entertainment') ? 6 : 3;

        $sql = " SELECT * FROM `tbl_news` WHERE `news_type` = ? AND `category` IN ('national', 'international') ORDER BY id DESC LIMIT ? ";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("si", $news_type, $limit);
        $stmt->execute();
        $rs = $stmt->get_result();
         if ($rs->num_rows == 0) {
            echo '<img src="https://placehold.co/450x260/png" " style="display: block; height: 100%; width: 40%;">';
            return;
        }
        while( $row = mysqli_fetch_assoc($rs) ) {

            echo '
            <div class="col-lg-4 col-md-6 col-12">
                <figure>
                    <a href="news-detail.php?id='.$row['id'].'" style="display: block; height: 100%;">
                        <div class="thumbnail" style="height: 250px; overflow: hidden; position: relative;">
                            <img src="admin/assets/image/'.$row['thumbnail'].'" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                            <div class="title" style="width: 100%;">'.substr($row['title'], 0, 45).'...</div>
                        </div>
                    </a>
                </figure>
            </div>
            ';

        }

    }

    //Get post news
    function get_post_news($news_type ,$category, $offset = 0, $limit = 6) {

        $con = connection_db();
        $sql = " SELECT * FROM `tbl_news` WHERE `news_type` = ? AND `category` = ? ORDER BY id DESC LIMIT ?, ? ";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssii", $news_type, $category, $offset, $limit);
        $stmt->execute();
        $rs = $stmt->get_result();
            if ($rs && $rs->num_rows == 0) {
                echo '<img src="https://placehold.co/450x260/png" " style="display: block; height: 100%; width: 40%;">';
                return;
            }
        while( $row = mysqli_fetch_assoc($rs) ) {

            echo '
                <div class="col-lg-4 col-md-6 col-12">
                    <figure>
                        <a href="news-detail.php?id='.$row['id'].'" style="display: block; height: 100%;">
                            <div class="thumbnail" style="height: 250px; overflow: hidden; position: relative;">
                                <img src="admin/assets/image/'.$row['thumbnail'].'" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <div class="detail" style="height: 150px; overflow: hidden; position: relative;">
                                <h3 class="title">'.substr($row['title'], 0, 40).'...</h3>
                                <div class="date">'.$row['created_at'].'</div>
                                <div class="description" style="word-wrap: break-word; overflow-wrap: break-word;">'.substr($row['description'], 0, 45).'...</div>
                            </div>
                        </a>
                    </figure>
                </div>
            ';

        }

    }

    // Feedback to us
    function feedback_to_us() {
        if(isset($_POST['btn_message'])){
            $name  = $_POST['name'];
            $email     = $_POST['email'];
            $phone = $_POST['phone'];
            $address   = $_POST['address'];
            $message   = $_POST['message'];
            $created_at = date('Y-m-d H:i:s');

            $con = connection_db();
            $stmt = $con->prepare("INSERT INTO `tbl_feedback`(`name`, `email`, `phone`, `address`, `message`, `created_at`) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $name, $email, $phone, $address, $message, $created_at);
            $rs = $stmt->execute();

            if($rs) {
                echo "
                    <script>
                        $(document).ready(function(){
                            swal('Success', 'Your message has been sent!', 'success');
                        });
                    </script>
                ";
            }
        }
    }

    feedback_to_us();

    //Count post news for pagination
    function count_post_news($news_type, $category) {
        $con = connection_db();
        $sql = " SELECT COUNT(id) as total FROM `tbl_news` WHERE `news_type` = ? AND `category` = ? ";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss", $news_type, $category);
        $stmt->execute();
        $rs = $stmt->get_result();
        $row = mysqli_fetch_assoc($rs);
        return $row['total'];
    }

    //Get search result
    function search_news($query) {

        $con = connection_db();
        $sql = " SELECT * FROM `tbl_news` WHERE `title` LIKE ? ORDER BY id DESC ";
        $stmt = $con->prepare($sql);
        $search_query = "%" . $query . "%";
        $stmt->bind_param("s", $search_query);
        $stmt->execute();
        $rs = $stmt->get_result();
        if ($rs->num_rows === 0) {
            echo '<div class="col-12 text-center"><img src="https://placehold.co/450x260/png?text=No+Results+Found" style="max-width: 100%; opacity: 0.7;"></div>';
        } else {
            while( $row = mysqli_fetch_assoc($rs) ) {
    
                echo '
                    <div class="col-lg-4 col-md-6 col-12">
                        <figure>
                            <a href="news-detail.php?id='.$row['id'].'" style="display: block; height: 100%;">
                                <div class="thumbnail" style="height: 250px; overflow: hidden; position: relative;">
                                    <img src="admin/assets/image/'.$row['thumbnail'].'" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div class="detail" style="height: 150px; overflow: hidden; position: relative;">
                                    <h3 class="title">'.substr($row['title'], 0, 40).'...</h3>
                                    <div class="date">'.$row['created_at'].'</div>
                                    <div class="description" style="word-wrap: break-word; overflow-wrap: break-word;">'.substr($row['description'], 0, 45).'...</div>
                                </div>
                            </a>
                        </figure>
                    </div>
                ';
    
            }
        }

    }