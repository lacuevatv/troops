<div class="owl-carousel">

	<?php 

	for ($i=0; $i < count($data); $i++) { ?>
		<div class="item">
	        <img src="<?php echo UPLOADSURL . '/' . $data[$i]; ?>" alt="Troops Viajes">
	    </div>
	<?php }//for ?>
</div>


<style>
    * {
        -webkit-box-sizing: border-box; /* Safari 3.0 - 5.0, Chrome 1 - 9, Android 2.1 - 3.x */
        -moz-box-sizing: border-box; /* Firefox 1 - 28 */
        box-sizing: border-box;
    }

    body, html {
        height: 100%;
    }

    img {
        vertical-align: middle;
    }

    .owl-carousel {
        height: 100%;
    }

    .owl-carousel .owl-item, .owl-carousel .item {
        height: 100vh;
    }

    .owl-carousel .owl-item img {
        transform-style: initial;
        height: 100%;
        object-fit: cover;
    }

    .owl-thumb-item img {
        width: 150px;
        height: auto;
    }

    .owl-thumbs {
        position: absolute;
        bottom: 0;
        left: 0;
        display: table;
        width: 100%;
        text-align: center;
        padding: 5%;
    }

    .owl-thumb-item {
        display: table-cell;
        border: none;
        background: none;
        padding: 0;
        opacity: .4;
    }

    .owl-thumb-item.active {
        opacity: 1;
    }

    .label {
        position: absolute;
        top: 20px;
        right: 20px;
        background-color: #0a6cff;
        color: white;
        padding: 10px 20px;
        z-index: 5;
        text-align: center;
    }
</style>