<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
    <?php echo $bids['websitename']; ?>
    </title>

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/animate.min.css'); ?>">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/calendar.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/generics.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/common.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/member.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/footer.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/datepicker.css'); ?>">

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/modal.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('layout/member/assets/css/main.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('layout/member/assets/css/custom.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('layout/member/assets/css/jquery.countdown.css'); ?>"><style type="text/css">
        .royaltypositionforsale
        {
            background-color: #72A230;
            padding-top: 5px;
            padding-bottom: 5px;
        }
        .tab-content
        {
            padding:10px;
        }
    </style>

</head>
<body>


	<header>
    <div class="floatLeft p-l-15" id="logotype">
        <a href="/" title="Crypto Cogent" style="color:white;"> <?php echo $bids['websitename']; ?></a>
    </div>

    <div class="member">
    Welcome : <?php echo $bids['username']; ?>
    </div>
    <div class="statistics">
    Total Members: 
    </div>
    <div class="statistics">
    Balance: <?php echo $bids['current_balance']; ?> USD
    </div>

    <div id="notify">
        <i class="fa fa-bell-o" id="alertBell"></i>
        <span id="notify-msg"></span>
    </div>

    <div class="pull-right" style="padding-top:3px; margin-right:5px;">
        <div id="google_translate_element"></div>
        <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
            }
        </script>
        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    </div>
    <div class="clear"></div>
	</header>

	<div class="container-fluid" id="content">
		<div class="row">
			<div class="col-sm-3" id="left">
            	<h3 class="menu-header">Member tools</h3>
            	<?php include('partial/menu.php'); ?>
			</div>
            <div class="col-sm-8 col-md-8" style="margin-top: 20px;">
            <div class="col-sm-12 col-md-12 royaltypositionforsale">
                     <div class="col-sm-12 col-md-7">
                        <h4 style="color:#FFFFFF; font-weight:900;">Bid For Royalty Positions</h4>
                    </div>
                    <div class="col-sm-12 col-md-5">
                       <a href="<?php echo base_url('marketplace'); ?>" class="btn btn-lg btn-default">Back To Royalty Positionss</a>
                    </div>
            </div>
              <p style="font-size:16px; margin-top: 10px;margin-bottom: 20px;">Use the form below to place a bid to buy Royalty Positions. Funds will be deducted from your account balance and held in escrow until a seller accepts your bid, or you cancel it.<br><br>
                </p>
                <div class="col-sm-12 col-md-12 royaltypositionforsale">
                     <div class="col-sm-12 col-md-12">
                        <h4 style="color:#FFFFFF; font-weight:900;">Place A Bid</h4>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12" style="margin-top: 20px;">
                    <div class="col-md-8">
                        <?php if($bids['error'] === '1'): ?>
                            <div class="alert alert-danger">
                                <h4>You Don't Have Sufficient Balance To Bid</h4>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-8">
                         <?php if($sell_rp['sellerror'] === 'request_submitted'): ?>
                            <div class="alert alert-info">
                                <h4>Your Request Has Been Submitted</h4>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12" style="margin-top: 30px;">
                    <?php echo form_open('marketplace/placebid') ?>
                        <div class="form-group">
                            <label for="amountosell">Royalty Positions Amount To Buy<?php echo $sell_rp['roy_pos']; ?></label>
                            <input type="text" name="royaltypositiontobid" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="salepriceperrp">Sale Price (Per RP) Willing To Pay</label>
                            <input type="text" name="salepriceperrp" class="form-control" required>
                        </div>
                        <div style="text-align: center;">
                        <input type="submit" name="SaleRP" class="btn btn-lg btn-primary" value="Place Your Bid" style="padding-left: 30px; padding-right: 30px;font-weight: 900;">
                        </div>
                    <?php echo form_close(); ?>
                </div>

            </div>
		</div>
	</div>						

<script src="http://www.cryptocogent.com/assets/bootstrap/js/jquery.min.js"></script>
<script src="http://www.cryptocogent.com/assets/bootstrap/js/jquery-ui.min.js"></script>
<script src="http://www.cryptocogent.com/assets/bootstrap/js/jquery.easing.1.3.js"></script>
<script src="http://www.cryptocogent.com/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="http://www.cryptocogent.com/assets/bootstrap/js/toggler.min.js"></script>
<script src="/assets/bootstrap/js/scroll.min.js"></script>
<script src="/assets/bootstrap/js/datepicker.js"></script>
<script src="/assets/scripts/tinynav.min.js"></script>

<!-- Site functions -->
<script src="http://www.cryptocogent.com/assets/scripts/ajaxupload.js"></script>
<script src="http://www.cryptocogent.com/assets/scripts/my_account.js"></script>
<script src="http://www.cryptocogent.com/assets/scripts/forms.js"></script>
<script src="http://www.cryptocogent.com/assets/scripts/modal.js"></script>
<script src="http://www.cryptocogent.com/assets/scripts/getList.js"></script>
<script src="http://www.cryptocogent.com/assets/scripts/tooltipsy.min.js"></script>
<script src="http://www.cryptocogent.com/assets/scripts/sortable.js"></script>

<script type="text/javascript" src="http://www.cryptocogent.com/layout/member/assets/js/jquery.plugin.min.js"></script><script type="text/javascript" src="http://www.cryptocogent.com/layout/member/assets/js/jquery.countdown.min.js"></script><script type="text/javascript">var mim = {
   baseUrl: 'http://www.cryptocogent.com/',
   assetPath: '/assets/',
   isGuest: false,
   isActive: false,
   launchtime: 0,
   alertInterval: 10000,
   alertCount: 0,
   teAlert: 'bell'
};
var currentDateTime = 0;</script><script type="text/javascript" src="http://www.cryptocogent.com/custom/js/flipclock.min.js"></script><script type="text/javascript" src="http://www.cryptocogent.com/custom/js/my_flipclock.js"></script>

<script src="http://www.cryptocogent.com/layout/member/assets/js/main.js"></script>

<script src="http://www.cryptocogent.com/assets/bootstrap/js/functions.js"></script>





</body>
</html>