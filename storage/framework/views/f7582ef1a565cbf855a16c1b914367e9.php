<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <title><?php echo $__env->yieldContent('title'); ?></title>
  <link rel="icon" href="<?php echo e(asset('assets/images/fav_icon.png')); ?>" type="image/x-icon">
  <link rel="shortcut icon" href="<?php echo e(asset('assets/images/fav_icon.png')); ?>" type="image/x-icon">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?php echo e(asset('/adminassets/plugins/fontawesome-free/css/all.min.css')); ?>">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo e(asset('/adminassets/plugins/select2/css/select2.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('/adminassets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('/adminassets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="<?php echo e(asset('/adminassets/dist/css/adminlte.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('/adminassets/dist/css/style.css')); ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/css/jquery-editable.css" rel="stylesheet"/>
  <?php echo $__env->yieldContent('css'); ?>
  <?php echo $__env->yieldContent('style'); ?>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="<?php echo e(asset('/adminassets/dist/img/AdminLTELogo.png')); ?>" alt="AdminLTELogo" height="60" width="60">
    </div> -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo e(route('adminlogout')); ?>" role="button">
            <i class="fas fa-home">Logout</i>
          </a>
          <form id="logout-form" action="<?php echo e(route('adminlogout')); ?>" method="POST" class="d-none">
            <?php echo csrf_field(); ?>
          </form>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>
      </ul>
    </nav>
     <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="<?php echo e(route('admin.dashboard')); ?>" class="brand-link">
        <img src="<?php echo e(asset('adminassets/dist/img/'.Auth::user()->photo)); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Panel</span>
      </a>
      <div class="sidebar">
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column mb-5" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-bar-chart" aria-hidden="true"></i>
                <p>
                  SEO
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a href="<?php echo e(route('blogs')); ?>" class="nav-link">
                    <i class="nav-icon fas fa-newspaper"></i>
                    <p>
                      Blogs
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo e(route('metakeywords')); ?>" class="nav-link">
                    <i class="nav-icon fas fa-newspaper"></i>
                    <p>
                       Meta Keywords
                    </p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fa-solid fa-square-share-nodes"></i>
                <p>
                  Social Media
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a href="<?php echo e(route('facebookPixcel', ['id' => 1])); ?>" class="nav-link">
                    <i class="nav-icon fab fa-facebook"></i>
                    <p>
                      Facebook Pixcel
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo e(route('socialLinks')); ?>" class="nav-link">
                    <i class="nav-icon fa-solid fa-square-share-nodes"></i>
                      <p>
                        Social Links
                      </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo e(route('instagram')); ?>" class="nav-link">
                    <i class="nav-icon fab fa-instagram"></i>
                      <p>
                        Instagram
                      </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo e(route('credentialpage')); ?>" class="nav-link">
                    <i class="nav-icon fas fa-key"></i>
                      <p>
                        Credentials
                      </p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-box-open"></i>
                <p>
                  Products
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a href="<?php echo e(route('category')); ?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Categories
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo e(route('allProducts')); ?>" class="nav-link">
                    <i class="nav-icon fas fa-box-open"></i>
                    <p>
                      Add Product
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo e(route('productSizeChart')); ?>" class="nav-link">
                    <i class="nav-icon fas fa-chart-bar"></i>
                    <p>
                      Product Size Chart
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo e(route('shipping')); ?>" class="nav-link">
                    <i class="nav-icon fas fa-money-bill"></i>
                    <p>
                      Shipping Cost
                    </p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(route('bankDetail')); ?>" class="nav-link">
                <i class="nav-icon fa fa-bank"></i>
                <p>
                  Bank Details
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(route('carouselImages')); ?>" class="nav-link">
                <i class="nav-icon fas fa-sliders-h"></i>
                <p>
                  Carousel Images
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(route('orders')); ?>" class="nav-link">
                <i class="nav-icon fas fa-box-open"></i>
                <p>
                  Orders
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(route('indexbulkOrder')); ?>" class="nav-link">
                <i class="nav-icon fas fa-paste"></i>
                  <p>
                    Bulk Orders
                    <?php
                      use App\Models\BulkOrder;
                      $bulkOrder = BulkOrder::where('status', '=', '0')->count();
                    ?>
                    <span class="badge badge-info right"><?php echo e($bulkOrder); ?></span>
                  </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(route('indexbulkSurvingOrder')); ?>" class="nav-link">
                <i class="nav-icon fas fa-box-open"></i>
                <p>
                  Bulk Serving Record
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(route('spottedGhazi')); ?>" class="nav-link">
                <i class="nav-icon fas fa-sliders-h"></i>
                <p>
                  Spotted in Ghazi
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(route('admincoupon')); ?>" class="nav-link">
                <i class="nav-icon fas fa-gift"></i>
                  <p>
                    Coupons
                  </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(route('currency')); ?>" class="nav-link">
                <i class="nav-icon fas fa-money-bill"></i>
                  <p>
                    Currency Rate
                  </p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>
    <div class="content-wrapper">
      <section class="content">
        <div class="container-fluid">
          <?php echo $__env->yieldContent('content'); ?>
        </div>
      </section>
    </div>
    <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>

<script src="<?php echo e(asset('/adminassets/plugins/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('/adminassets/plugins/select2/js/select2.full.min.js')); ?>"></script>
<script src="<?php echo e(asset('/adminassets/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?php echo e(asset('/adminassets/dist/js/adminlte.js')); ?>"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script src="<?php echo e(asset('/adminassets/dist/js/jquery-editable-poshytip.min.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<?php echo $__env->yieldContent('script'); ?>
<script>$.fn.poshytip={defaults:null}</script>

<script>
  function configureCKEditor(selector) {
    const element = document.querySelector(selector);
    if (element) {
      ClassicEditor
        .create(element, {
          heading: {
            options: [
              { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
              { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
              { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
              { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
            ]
          }
        })
        .catch(error => {
          console.error(`Error initializing CKEditor for ${selector}:`, error);
        });
    } else {
      console.error(`Element with selector ${selector} not found.`);
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    configureCKEditor('#editor1');
    configureCKEditor('#editor2');
  });
</script>
<script>
  $(document).ready(function () 
  {
    $('#myDataTable').DataTable();
  });
</script>
<?php if(Session::has('message')): ?>
<script>
	{
		toastr.options = {
			"progressBar" : false,
			"closeButton" : true,
		}
		toastr.success("<?php echo e(Session::get('message')); ?>", "Success!");
	}
</script>
<?php endif; ?>
<?php if(Session::has('error')): ?>
<script>
	{
		toastr.options = {
			"progressBar" : false,
			"closeButton" : true,
		}
		toastr.error("<?php echo e(Session::get('error')); ?>");
	}
</script>
<?php endif; ?>
<script>
  $("#startat").flatpickr({
   "enableTime": true,
    minDate: 'today',
   dateFormat: "Y-m-d H:i:S",
  });
  $("#endat").flatpickr({
    "enableTime": true,
     dateFormat: "Y-m-d H:i:S",
     time_24hr: true,
     });
</script>
<script>
  $(document).ready(function() {
    $.fn.editable.defaults.mode = 'inline';
    $.ajaxSetup({
      headers:{
        'X-CSRF-TOKEN' : '<?php echo e(csrf_token()); ?>'
      }
    });
    $('.editable').editable({
      url: '#',
      type:'text',
      pk:1,
      name:'price',
      title:'Enter Price',
      success: function(response, newValue) {

        // Reload the page after the editable action is completed
        window.location.reload();
    }
    });
    $('.selecteditable').editable({
    type: 'select',
    // value: "",
    pk: function() {
            return $(this).data('pk');
        },
    name:'status',
    url: '#',
    source: [
        {value: "1", text: 'Pending'},
        {value: "2", text: 'Accepted'},
        {value: "0", text: 'Delivered'}
    ],
    success: function(response, newValue) {

    // Reload the page after the editable action is completed
    window.location.reload();
    }
    });
  });
</script>
<script>
  $(document).ready(function(){
    //Initialize Select2 Elements
    $('#customerselect').select2({
    })
  $("#customerselect").change(function(){
   var uservalue = $("#customerselect").val();
   if(uservalue == 0){
    $("#maxuses").prop('disabled', true);
   }
   else{
    $("#maxuses").prop('disabled', false);
   }
  });
});
</script>
<script>
  $("#submit-btn").click(function(){
   $("#updateorderform").submit();
  });
</script>
</body>
</html>
<?php /**PATH /home/ghazi1984/public_html/resources/views/layouts/adminmaster.blade.php ENDPATH**/ ?>