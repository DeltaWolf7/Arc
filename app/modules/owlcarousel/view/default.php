<?php
system\Helper::arcAddFooter("css", system\Helper::arcGetModulePath("owlcarousel") . "css/owl.carousel.css");
system\Helper::arcAddFooter("css", system\Helper::arcGetModulePath("owlcarousel") . "css/owl.theme.css");
system\Helper::arcAddFooter("css", system\Helper::arcGetModulePath("owlcarousel") . "css/owl.transitions.css");
system\Helper::arcAddFooter("js", system\Helper::arcGetModulePath("owlcarousel") . "js/owl.carousel.min.js");
?>

<div id="owl-demo" class="owl-carousel owl-theme">

    <div class="item"><img src="<?php echo system\Helper::arcGetModulePath("owlcarousel") ?>images/bg1.jpg" alt="bg1"></div>
    <div class="item"><img src="<?php echo system\Helper::arcGetModulePath("owlcarousel") ?>images/bg2.jpg" alt="bg2"></div>

</div>

<script>
    $(document).ready(function () {
        $("#owl-demo").owlCarousel({
            autoPlay: 3000,
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true,
            itemsScaleUp: true
        });

    });
</script>