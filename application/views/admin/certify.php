
		<main class="content">
			<div class="container-fluid">
				<div class="content-header">
					<h1></h1>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="dashboard-1.html">Dashboard</a></li>
							<li class="breadcrumb-item active">Inserisci nuovo utente</li>
						</ol>
					</nav>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<form class="box needs-validation" method="post" action="<?php echo base_url('index.php/')?>admin/updatefile">
							
							<div class="box-body" id="loadcert">
								<div class="row">
								Start of external management. Confirm the transaction in your metamask..
                               </div>
								<div id="loader">
									<img src="<?php echo base_url()?>/images/straight-loader.gif" width="200px" height="200px">
								</div>
                            </div>
							<div class="box-body" id="confirmcert">
							<div class="alert alert-success">
								<h3>Your Transaction is proceeding please wait and fill form below </h3>
                            </div>
								<div class="row">
									<div class="col-sm-12 form-group">
										<label for="jsValidationnominativo"><b>Enter Block Chain Link</b></label>
										<input id="jsValidationnominativo" name="blockchain" type="text" class="form-control" placeholder="Blockchain link" required>
										<span class="valid-feedback">Fine!</span>
										<span class="invalid-feedback">Field is required.</span>
									</div>
									<div class="col-sm-12 form-group">
										<label for="jsValidationnominativo"><b>Enter Transaction Hash</b></label>
										<input id="jsValidationnominativo" name="tranhash" type="text" class="form-control" placeholder="Transaction" required>
										<span class="valid-feedback">Fine!</span>
										<span class="invalid-feedback">Field is required.</span>
									</div>
									<input type="hidden" name="docid" value="<?=$docid?>">
									<div class="box-footer">
								        <button class="btn btn-primary pull-right">Certify</button>
							        </div>
								</div>
								
								
							</div>
							
						</form>
					</div>
					
				</div>
			
		</main>

	<script src="<?=base_url()?>/node_modules/web3/dist/web3.min.js"></script> 
	<script src="https://unpkg.com/@metamask/detect-provider/dist/detect-provider.min.js"></script>
	<script type="text/javascript">
	    var code = "0x<?php echo $certificat[0]->hex;  ?>"; //alert(code);
		var ufficio = "<?php  echo $offcdata->wallet;?>"; //alert(ufficio);
		var operatore = "<?php echo $userinfo->userwallet;?>";//alert(operatore);
		const provider =  detectEthereumProvider()
		if (provider) {
			const ethereum = window.ethereum;
			console.log("window.etherium",ethereum)

			ethereum
			.request({ method: 'eth_accounts' })
			.then((accounts) => {
				console.log('Accounts:',accounts);
				try {
				const transactionHash = ethereum.request({
					method: 'eth_sendTransaction',
					params: [
					{
						from: operatore,
						to: ufficio, 
						value: web3.toWei(0, "ether"),
						gasPrice: '0x2540BE400',
						gas: '0x7530',  
						data: code
						// And so on...
					},
					],
				});
  // Handle the result
                    document.getElementById('confirmcert').style.display='block';
                    document.getElementById('loadcert').style.display='none';
					
					//console.log('My transaction is '+transactionHash);
				} 
				catch (error) {
					console.error(error);
				}
			})
			.catch((error) => {
				console.error(
				`Error fetching accounts: ${error.message}.
				Code: ${error.code}. Data: ${error.data}`
				);
			});

			//alert("connected");
			console.log(provider)
		} else {
			alert(" not connected")
		}
	</script>
	<script type="text/javascript">
	// this function detects most providers injected at window.ethereum
	/*import detectEthereumProvider from '@metamask/detect-provider';
    alert('sssss');
	const provider = await detectEthereumProvider();

	if (provider) {
	// From now on, this should always be true:
	// provider === window.ethereum
	startApp(provider); // initialize your app
	} else {
	console.log('Please install MetaMask!');
	}*/
/*window.addEventListener('load', () => {
    if (typeof web3 !== 'undefined') {
        web3 = new Web3(web3.currentProvider);
		ethereum._metamask.isApproved();alert(ethereum._metamask.isApproved());
    } else {
        console.log('No web3? You should consider trying MetaMask!');
        web3 = new Web3(new Web3.providers.WebsocketProvider('https://localhost:8545'));
    }
});

var code = "0x<?php echo $certificat[0]->hex;  ?>"; //alert(code);
var ufficio = "<?php  echo $offcdata->wallet;?>"; //alert(ufficio);
var operatore = "<?php echo $userinfo->userwallet;?>";//alert(operatore);

web3.eth.sendTransaction({
    from: operatore,
    to: ufficio, 
    value: web3.toWei(0, "ether"),
    gasPrice: '0x2540BE400',
    gas: '0x7530',  
    data: code,
}, function(err, transactionHash) {
	ethereum.autoRefreshOnNetworkChange=false;
    if (err) { alert(err+'error');
	   document.getElementById('loader').innerHtml=err;
      //  console.log(err); 
    } else { alert(transactionHash);
	    document.getElementById('loader').innerHtml=transactionHash;
        console.log(transactionHash);
    }
});*/
</script>
