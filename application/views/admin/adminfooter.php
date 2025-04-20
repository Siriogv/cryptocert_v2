<footer class="footer">

			<p><?php echo $offcdata->intestazione?> © 2018 All Rights Reserved.  <?php echo $offcdata->email?> | <?php echo $offcdata->telefono?></p>

		

		</footer>

	</div>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5bc61d9061d0b77092516943/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
    
	<script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>

	<script src="<?=base_url()?>/assets/js/app.js"></script>
	<script src="<?=base_url()?>/node_modules/web3/dist/web3.min.js" type="module"></script> 
	<script src="https://unpkg.com/@metamask/detect-provider/dist/detect-provider.min.js" type="module"></script>
	<script type="text/javascript">
	    //const provider =  detectEthereumProvider();
	    const web3Provider = new Web3(ethereum);
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