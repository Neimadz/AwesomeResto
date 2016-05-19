
<?php require_once 'inc/header.php'; ?>

<?php if(isset($formvalid) && $formValid = true): ?>
            <div class="alert alert-success">
                Congrats! Your message has been sent.
            </div>
        <?php endif; ?>

        <?php if(isset($displayErr ) && $displayErr  == true): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach($error as $err): ?>
                        <li><?=$err;?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h1 class="page-header text-center"> Contactez nous </h1>
                <form class="form-horizontal" role="form" method="post">
                    <div class="form-group">
                        <label for="name" id="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name">
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" id="name" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com">
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message" id="name" class="col-sm-2 control-label">Message</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="4" name="message"></textarea>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="human" id="name" class="col-sm-2 control-label"> 8 + 3 = ?</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="human" name="human" placeholder="Your Answer">
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>   
    
<?php include_once 'inc/footer.php'; ?>