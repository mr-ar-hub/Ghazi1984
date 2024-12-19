<!DOCTYPE html>
<html>
<head>
    <title>New Order</title>
    <style>
        h1,h2{
        margin: 0;
        padding: 0;
        }
        p{
        padding: 0;
        margin: 0;
        }
        #email_template {
        width: 100%;
        position: relative;
        font-family: "Roboto", sans-serif;
        color: #111 !important;
        }
        #email_template .content {
        min-width: 650px;
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        }
        #email_template .content .header img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        #email_template .content .footer {
            background-color: #9A1F94;
            padding-top: 40px;
            padding-bottom: 5px;
            position: relative;
            color:#fff;
        }
        #email_template .content .footer .footer-width {
            text-align: center !important;
            border-bottom: 1px solid #fff;
        }
          #email_template .content .footer .footer-bottom {
            text-align: center !important;
            color:#fff;
            padding:15px 0;
        }
        #email_template .content .footer .footer-width p {
            font-size: 18px;
        }
        #email_template .content .footer .footer-width .font-b {
            font-size: 18px;
            text-decoration: underline;
            padding-bottom: 15px;
        }

        #email_template .content .footer .footer-bottom p a {
            font-size: 18px;
            font-weight: 300;
/*            font-style: italic;*/
            text-decoration: none;
            color: #fff;
        }
        #email_template .content .footer .footer-width .footer-img img {
            width: 26px;
            height: 26px;
            margin: 0px 20px;
            color: white;
        }
         #email_template .content .footer .footer-bottom span{
            text-decoration: underline;
         }
       #email_template .content .footer .footer-bottom span:nth-child(1) {
            margin-right: 100px;
        }
        #email_template .content .footer .footer-bottom .footer-bottom-b-block{
            padding:40px 0;
        }
        #email_template .content .footer .footer-bottom .font-end{
            font-weight: 300;
        }
        .footer-img a img{
            object-fit: contain;
            filter: brightness(0) invert(1) !important;
            border:1px solid #fff;
            border-radius: 50%;
            padding: 10px;
        }
        .footer .footer-width h2{
            font-weight: 400 !important;
            padding: 10px 0px;
        }
        .text-light {
        font-weight: 300;
        font-style: italic;
        padding-bottom: 20px;
        }
        .image-container {
            display: flex;
            flex-wrap: wrap;
        }
        .file-wrapper {
            position: relative;
            margin: 10px;
        }
    
        .file-wrapper img,
        .file-wrapper .pdf-thumbnail {
            width: 100px;
            height: 100px;
            object-fit: cover;
            display: block;
        }
    
        .pdf-thumbnail {
            background: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            color: #333;
            border: 1px solid #ccc;
        }
    
        .download-icon {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border-radius: 50%;
            padding: 5px;
            cursor: pointer;
            text-align: center;
            font-size: 14px;
            display: none; /* Hide by default */
        }
    
        .file-wrapper:hover .download-icon {
            display: block; /* Show on hover */
        }
    </style>

</head>
<body>
    <div class="email_template" id="email_template">
        <div class="content">
            <div class="header">
                <img src="https://ghazi1984.com/assets/images/banner.jpg" />
            </div>
            <?php echo $__env->yieldContent('content'); ?>
            <div class="footer">
                <div class="footer-width">
                    <div class="footer-img">
                        <a href="https://www.instagram.com/ghazi1984thebrand" target="_blank">
                            <img src="https://staging2.ideanet.it/assets/images/instagram.png" />
                        </a>
                        <a href="https://www.facebook.com/Ghazi1984thebrand" target="_blank">
                            <img src="https://staging2.ideanet.it/assets/images/facebook.png" />
                        </a>
                    </div>
                    <p class="font-b"><a style="color: #fff;" href="https://ghazi1984.com">ghazi1984.com</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH /home/ghazi1984/public_html/resources/views/emails/master.blade.php ENDPATH**/ ?>