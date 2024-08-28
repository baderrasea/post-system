<?php 
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: signin.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/admin_style.css">
    
    <title>Home</title>
</head>
<body></body>
<section id="sidebar">
<div class="white-label">
</div>
<div id="sidebar-nav">
<ul>
<li class="active"><a href="#"><i class="fa fa-dashboard"></i> users</a></li>
</ul>
</div>
</section>
<section id="content">
<div class="nav">
    <div class="logo">
        <a href="index.php">Logo</a>
    </div>

    <div class="right-links">
        <?php 
        $id = $_SESSION['id'];
        $query = mysqli_query($con, "SELECT * FROM users WHERE Id = $id");
        while ($result = mysqli_fetch_assoc($query)) {
            $res_Uname = $result['Username'];
            $res_Email = $result['Email'];
            $res_Age = $result['Age'];
            $res_id = $result['Id'];
        }
        echo "<a href='edit.php?Id=$res_id' class='link'>Change Profile</a>";
        ?>
        <a href="my_posts.php"><button class="btn">my post</button></a>
        <a href="new_post.php"><button class="btn"> add post</button></a>
        <a href="php/logout.php"><button class="btn" style="background-color: red;">Log Out</button></a>
    </div>
</div>


   
    <div class="content">
            <div class="content-header">
                <h1>Users</h1>
            </div>

<table class="table table-hover table-bordered" id="list2">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>name</th>
						<th>role</th>
						<th>email</th>
						<th>actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $con->query("SELECT * FROM users");
					while ($row = $qry->fetch_assoc()) :
					?>
						<tr>
							<th class="text-center"><?php echo $i++ ?></th>
							<td><b><?php echo ucwords($row['Username']) ?></b></td>
							<td><b>
									<?php if ($row['roles'] == 1) {
											echo "admin";
                                             
										}
                                        else
                                        echo "subscribr";
                                        ?>
								</b></td>
							<td><b><?php echo $row['Email'] ?></b></td>
							<td class="text-center">
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            Actions
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <li><a class="dropdown-item view_user" href="#" data-id="<%= user_id %>">view</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item edit_user" href="#" data-id="<%= user_id %>">edit</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item delete_user" href="#" data-id="<%= user_id %>">delete</a></li>
</ul>
    </div>
</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>

    </div>
</section>
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<!-- DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<script>
	$(document).ready(function() {
		$('#list2').dataTable({
			language: {
				url: 'assets/dist/ar-datatable.json'
			}
		})
		$('.view_user').click(function() {
			uni_modal("<i class='fa fa-id-card'></i> تفاصيل المستخدم", "includes/view_user.php?id=" + $(this).attr('data-id'))
		})
		$('.delete_user').click(function() {
			_conf("هل انت متاكد من حذف المستخدم؟", "delete_user", [$(this).attr('data-id')])
		})
	})




document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.dropdown-toggle').forEach(button => {
        button.addEventListener('click', function() {
            const dropdownMenu = this.nextElementSibling;
            dropdownMenu.classList.toggle('show');
        });
    });

    document.addEventListener('click', function(event) {
        if (!event.target.matches('.dropdown-toggle')) {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });
        }
    });
});
$(document).ready(function() {
    $('#list').on('click', '.delete_user', function() {
        var userId = $(this).data('id');
        
        if (confirm('Are you sure you want to delete user with ID: ' + userId + '?')) {
            $.ajax({
                url: 'delete_user.php',
                type: 'POST',
                data: { id: userId },
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.success) {
                        alert('User deleted successfully');
                        $('#usersTable').DataTable().ajax.reload(); // Reload table data
                    } else {
                        alert('Error deleting user: ' + result.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + error);
                }
            });
        }
    });
});


</script>