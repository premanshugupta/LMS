<!doctype html>
<html lang="en">


<!-- Mirrored from codervent.com/rocker/demo/vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2017], Fri, 01 Nov 2024 07:05:37 GMT -->
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{url('assets/images/favicon-32x32.png')}}" type="image/png"/>
	<!--plugins-->
	<link href="{{url('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
	<link href="{{url('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="{{url('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
	<link href="{{url('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet"/>
	<!-- loader-->
	<link href="{{url('assets/css/pace.min.css')}}" rel="stylesheet"/>
	<script src="{{url('assets/js/pace.min.js')}}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{url('assets/css/bootstrap-extended.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="{{url('assets/css/app.css')}}" rel="stylesheet">
	<link href="{{url('assets/css/icons.css')}}" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{url('assets/css/dark-theme.css')}}"/>
	<link rel="stylesheet" href="{{url('assets/css/semi-dark.css')}}"/>
	<link rel="stylesheet" href="{{url('assets/css/header-colors.css')}}"/>
	<title>@yield('title', 'Custom Auth Laravel')</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		{{-- @include('student.student_sidebar') --}}
		@include('student.student_sidebar', ['assignedBatches' => $assignedBatches ?? []])
		<!--end sidebar wrapper -->
		<!--start header -->
		@include('student.student_header')
		<!--end header -->
		<!--start page wrapper -->
		@yield('material')
		<!--end page wrapper -->
		<!--start overlay-->
		 <div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button-->
		  <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		@include('footer')
	</div>
	<!--end wrapper-->


	<!-- search modal -->
    <div class="modal" id="SearchModal" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-md-down">
		  <div class="modal-content">
			<div class="modal-header gap-2">
			  <div class="position-relative popup-search w-100">
				<input class="form-control form-control-lg ps-5 border border-3 border-primary" type="search" placeholder="Search">
				<span class="position-absolute top-50 search-show ms-3 translate-middle-y start-0 top-50 fs-4"><i class='bx bx-search'></i></span>
			  </div>
			  <button type="button" class="btn-close d-md-none" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="search-list">
				   <p class="mb-1">Html Templates</p>
				   <div class="list-group">
					  <a href="javascript:;" class="list-group-item list-group-item-action active align-items-center d-flex gap-2 py-1"><i class='bx bxl-angular fs-4'></i>Best Html Templates</a>
					  <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-vuejs fs-4'></i>Html5 Templates</a>
					  <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-magento fs-4'></i>Responsive Html5 Templates</a>
					  <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-shopify fs-4'></i>eCommerce Html Templates</a>
				   </div>
				   <p class="mb-1 mt-3">Web Designe Company</p>
				   <div class="list-group">
					  <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-windows fs-4'></i>Best Html Templates</a>
					  <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-dropbox fs-4' ></i>Html5 Templates</a>
					  <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-opera fs-4'></i>Responsive Html5 Templates</a>
					  <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-wordpress fs-4'></i>eCommerce Html Templates</a>
				   </div>
				   <p class="mb-1 mt-3">Software Development</p>
				   <div class="list-group">
					  <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-mailchimp fs-4'></i>Best Html Templates</a>
					  <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-zoom fs-4'></i>Html5 Templates</a>
					  <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-sass fs-4'></i>Responsive Html5 Templates</a>
					  <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-vk fs-4'></i>eCommerce Html Templates</a>
				   </div>
				   <p class="mb-1 mt-3">Online Shoping Portals</p>
				   <div class="list-group">
					  <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-slack fs-4'></i>Best Html Templates</a>
					  <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-skype fs-4'></i>Html5 Templates</a>
					  <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-twitter fs-4'></i>Responsive Html5 Templates</a>
					  <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-vimeo fs-4'></i>eCommerce Html Templates</a>
				   </div>
				</div>
			</div>
		  </div>
		</div>
	  </div>
    <!-- end search modal -->


	<!--start switcher-->
	<div class="switcher-wrapper">
		<div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
		</div>
		<div class="switcher-body">
			<div class="d-flex align-items-center">
				<h5 class="mb-0 text-uppercase">Theme Customizer</h5>
				<button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
			</div>
			<hr/>
			<h6 class="mb-0">Theme Styles</h6>
			<hr/>
			<div class="d-flex align-items-center justify-content-between">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked>
					<label class="form-check-label" for="lightmode">Light</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
					<label class="form-check-label" for="darkmode">Dark</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark">
					<label class="form-check-label" for="semidark">Semi Dark</label>
				</div>
			</div>
			<hr/>
			<div class="form-check">
				<input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
				<label class="form-check-label" for="minimaltheme">Minimal Theme</label>
			</div>
			<hr/>
			<h6 class="mb-0">Header Colors</h6>
			<hr/>
			<div class="header-colors-indigators">
				<div class="row row-cols-auto g-3">
					<div class="col">
						<div class="indigator headercolor1" id="headercolor1"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor2" id="headercolor2"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor3" id="headercolor3"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor4" id="headercolor4"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor5" id="headercolor5"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor6" id="headercolor6"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor7" id="headercolor7"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor8" id="headercolor8"></div>
					</div>
				</div>
			</div>
			<hr/>
			<h6 class="mb-0">Sidebar Colors</h6>
			<hr/>
			<div class="header-colors-indigators">
				<div class="row row-cols-auto g-3">
					<div class="col">
						<div class="indigator sidebarcolor1" id="sidebarcolor1"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor2" id="sidebarcolor2"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor3" id="sidebarcolor3"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor4" id="sidebarcolor4"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor5" id="sidebarcolor5"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor6" id="sidebarcolor6"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor7" id="sidebarcolor7"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor8" id="sidebarcolor8"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src="{{url('assets/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
	<script src="{{url('assets/js/jquery.min.js')}}"></script>
	<script src="{{url('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{url('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{url('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
	<script src="{{url('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{url('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
	<script src="{{url('assets/plugins/chartjs/js/chart.js')}}"></script>
	<script src="{{url('assets/js/index.js')}}"></script>
	<!--app JS-->
	<script src="{{url('assets/js/app.js')}}"></script>
	<script>
		new PerfectScrollbar(".app-container")
	</script>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
		 const viewButtons = document.querySelectorAll('.view-btn');
		 const fileViewer = document.getElementById('fileViewer');
	 
		 viewButtons.forEach(button => {
			 button.addEventListener('click', function () {
				 const filePath = this.getAttribute('data-file');
				 fileViewer.src = filePath; // Update iframe to show PDF
			 });
		 });
	 });
	 
	 </script>
	 <script>
		// Script to update iframe source dynamically
		document.addEventListener('DOMContentLoaded', function () {
			const viewButtons = document.querySelectorAll('.view-btn');
			const pdfViewer = document.getElementById('pdfViewer');
	
			viewButtons.forEach(button => {
				button.addEventListener('click', function () {
					const filePath = this.getAttribute('data-file');
					pdfViewer.src = filePath;
				});
			});
		});
	</script>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
    const viewVideoButtons = document.querySelectorAll('.view-video-btn');
    const videoPlayer = document.getElementById('videoPlayer');

    viewVideoButtons.forEach(button => {
        button.addEventListener('click', function () {
            const videoUrl = this.getAttribute('data-video');

            // Check if the video link is from YouTube
            if (videoUrl.includes("youtube.com") || videoUrl.includes("youtu.be")) {
                // Extract the video ID from YouTube URL
                let videoId = videoUrl.split("v=")[1];
                if (videoId.includes("&")) {
                    // Handle multiple query parameters (e.g., after & sign)
                    videoId = videoId.split("&")[0];
                }

                // Construct the embeddable URL for YouTube
                const embedUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1`;

                videoPlayer.src = embedUrl;
            } else {
                // For other video links (e.g., Vimeo or direct file paths), use the link directly
                videoPlayer.src = videoUrl;
            }
        });
    });
});
	</script>

	{{-- Start student lecture page --}}
	<!-- Script for Video Modal -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const viewVideoButtons = document.querySelectorAll('.view-video-btn');
        const videoPlayer = document.getElementById('videoPlayer');

        viewVideoButtons.forEach(button => {
            button.addEventListener('click', function () {
                const videoUrl = this.getAttribute('data-video');

                // Embed YouTube URL handling
                if (videoUrl.includes("youtube.com") || videoUrl.includes("youtu.be")) {
                    let videoId = videoUrl.includes("v=") ? videoUrl.split("v=")[1] : videoUrl.split("/").pop();
                    if (videoId.includes("&")) {
                        videoId = videoId.split("&")[0];
                    }
                    videoPlayer.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
                } else {
                    // Non-YouTube video URLs
                    videoPlayer.src = videoUrl;
                }
            });
        });

        // Clear the iframe when modal is closed
        document.getElementById('videoModal').addEventListener('hidden.bs.modal', function () {
            videoPlayer.src = '';
        });
    });
</script>
<script>
	document.addEventListener('DOMContentLoaded', function () {
    const viewVideoButtons = document.querySelectorAll('.open-link-btn');
    const videoPlayer = document.getElementById('linkViewer');

    viewVideoButtons.forEach(button => {
        button.addEventListener('click', function () {
            const videoUrl = this.getAttribute('data-link');

            // Check if the video link is from YouTube
            if (videoUrl.includes("youtube.com") || videoUrl.includes("youtu.be")) {
                // Extract the video ID from YouTube URL
                let videoId = videoUrl.split("v=")[1];
                if (videoId.includes("&")) {
                    // Handle multiple query parameters (e.g., after & sign)
                    videoId = videoId.split("&")[0];
                }

                // Construct the embeddable URL for YouTube
                const embedUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1`;

                videoPlayer.src = embedUrl;
            } else {
                // For other video links (e.g., Vimeo or direct file paths), use the link directly
                videoPlayer.src = videoUrl;
            }
        });
    });
});
</script>
{{-- end student lecture page --}}
</body>


<!-- Mirrored from codervent.com/rocker/demo/vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2017], Fri, 01 Nov 2024 07:08:17 GMT -->
</html>