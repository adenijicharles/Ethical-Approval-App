<?php require_once "includes/login_header.php"; ?>
    <section class="inline-block width-50 align-top">
        <div class="margin-center text-center margin-t100" style="width: 400px">
            <figure>
                <img src="assets/image/logo.gif">
            </figure>                    
        </div>       
        <div class="width-100 margin-t30 text-center">
            <h3 class="font-bold"> <b>EXPERIMENT ETHICAL APPROVER</b> </h3>
            <h5 class="font-bold"> <b>STUDENT LOGIN</b> </h5>
        </div>     
        
        <div class="account-form margin-center">
            <form action="" method="">
                <div class="form-group margin-b10">
                    <label> Student ID </label>
                    <input type="number" name="student_id" required>
                </div>                 
                <div class="form-group margin-b10">
                    <label> Password </label>
                    <input type="password" id="password" name="password" required>
                    <span id="pass"> show password </span>
                </div> 
                <div class="form-group margin-b10">                            
                    <input type="submit" value="Login">                            
                </div>                                                                             
            </form>
        </div>            
    </section>
<?php require_once "includes/login_footer.php"; ?>    