        </div> <!-- Close main-content -->
    </div> <!-- Close container-fluid -->

    <footer class="footer mt-auto py-3 bg-light fixed-bottom">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-auto text-center">
                    <p class="text-muted mb-0"><?php echo $offcdata->intestazione?> © 2018 All Rights Reserved.  <?php echo $offcdata->email?> | <?php echo $offcdata->telefono?></p>
                </div>    
            </div>
        </div>
    </footer>


<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;

s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
    
        <script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="<?=base_url()?>/assets/js/app.js"></script>
	<!-- <script src="<?=base_url()?>/node_modules/web3/dist/web3.min.js" type="module"></script>  -->
	<script src="https://unpkg.com/@metamask/detect-provider/dist/detect-provider.min.js" type="module"></script>
	<script type="text/javascript">
	    //const provider =  detectEthereumProvider();
	    //const web3Provider = new Web3(ethereum);
        // Function to adjust main content margin based on sidebar state
        function adjustMainContentMargin() {
            const sidebar = $('#sidebar');
            const mainContent = $('.main-content');
            if (sidebar.hasClass('active')) {
                mainContent.css('margin-left', '250px');
            } else if (sidebar.hasClass('icon-only')) {
                mainContent.css('margin-left', '70px');
            } else {
                mainContent.css('margin-left', '0');
            }
        }

        // Initial adjustment on page load
        $(document).ready(function() {
            adjustMainContentMargin();
        });

        // Toggle sidebar functionality
        $(document).ready(function() {
          const sidebar = $('#sidebar');
          $('#sidebar-toggle').on('click', function(){
            sidebar.toggleClass('icon-only');
            sidebar.toggleClass('active', !sidebar.hasClass('icon-only'));
            adjustMainContentMargin();
          });
        });



	   if (web3Provider) {
	    const ethereum = window.ethereum;
		console.log("window.etherium",ethereum);       
	    ethereum.enable().then((account) => {
	        const defaultAccount = account[0]
	        web3Provider.eth.defaultAccount = defaultAccount
	        
	    })
	   }
	</script>
</body>



</html>
