<x-header :bootstrap="$bootstrap"/>
<x-navbar :navbar="$navbar"/>

<div class="home-container">
    <img src="img/logo.png" alt="">

    <?php
        if(isset($list)){
            print_r($list);
        }
    ?>
</div>
