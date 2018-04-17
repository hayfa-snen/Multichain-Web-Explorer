<?php	
	require_once './include/functions.php';
	$config=read_config();
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>MultiChain Web Explorer</title>
		<link type='image/png' rel='icon' href='img/logo_multichain.png' />
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/styles.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</head>
	<body>
		<div class="container">
			<h1><a href="./?page=home">MultiChain Web Explorer</a>
				<?php if (@$config['name']) { ?> &ndash; <?php echo html($config['name']); } ?>
			</h1>
<?php
	if (@$config['name']) {
?>			
			<nav class="navbar navbar-default">
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li><a href="./?page=node">Node</a></li>
						<li><a href="./?page=permissions">Permissions</a></li>
						<li><a href="./?page=issue" class="pair-first">Issue Asset</a></li>
						<li><a href="./?page=update" class="pair-second">| Update</a></li>
						<li><a href="./?page=send">Send</a></li>
						<li><a href="./?page=offer" class="pair-first">Create Offer</a></li>
						<li><a href="./?page=accept" class="pair-second">| Accept</a></li>
						<li><a href="./?page=create">Create Stream</a></li>
						<li><a href="./?page=publish">Publish</a></li>
						<li><a href="./?page=view">View Streams</a></li>
					</ul>
				</div>
			</nav>
<?php
		set_multichain_chain($config);
		
		switch (@$_GET['page']) {
			case 'label':
			case 'permissions':
			case 'issue':
			case 'update':
			case 'send':
			case 'offer':
			case 'accept':
			case 'create':
			case 'publish':
			case 'view':
			//case 'asset-file':
				require_once 'pages/page-'.$_GET['page'].'.php';
				break;
				
			default:
				require_once 'pages/page-default.php';
				break;
		}
		
	} else {
?>
			<p class="lead"><br/>Define your MultiChain node credentials below:</p>
		
			<p>
				<form class="form-horizontal" method="post" enctype="multipart/form-data" action="./">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Chain name:</label>
						<div class="col-sm-9">
							<input class="form-control" name="name" id="name" placeholder="chain1" required>
						</div>
					</div>
					<div class="form-group">
						<label for="rpchost" class="col-sm-2 control-label">RPC host:</label>
						<div class="col-sm-9">
							<input class="form-control" name="rpchost" id="rpchost" placeholder="IP address of MultiChain node" required>
						</div>
					</div>
					<div class="form-group">
						<label for="rpcport" class="col-sm-2 control-label">RPC port:</label>
						<div class="col-sm-9">
							<input class="form-control" type="number" min="0" max="9999" name="rpcport" id="rpcport" placeholder="usually default-rpc-port from params.dat" required>
						</div>
					</div>
					<div class="form-group">
						<label for="rpcuser" class="col-sm-2 control-label">RPC user:</label>
						<div class="col-sm-9">
							<input class="form-control" name="rpcuser" id="rpcuser" placeholder="username for RPC from multichain.conf" required>
						</div>
					</div>
					<div class="form-group">
						<label for="rpcpassword" class="col-sm-2 control-label">RPC password:</label>
						<div class="col-sm-9">
							<input class="form-control" type="password" name="rpcpassword" id="rpcpassword" placeholder="password for RPC from multichain.conf" required>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-9">
							<input class="btn btn-default" type="submit" name="connection" value="Connection">
						</div>
					</div>
				</form>			
			</p>
	
			<form class="form-horizontal" method="post" enctype="multipart/form-data" action="./">
				<p class="lead">
					<br/>Or try our Test node: &ensp;
					<input class="btn btn-default" type="submit" name="connection_test" value="Connect to Test node">
				</p>
			</form>
<?php
	}
?>
		</div>
	</body>
</html>