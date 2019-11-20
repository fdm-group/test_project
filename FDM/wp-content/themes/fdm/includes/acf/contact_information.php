<div class="contact-info">
    <div class="header">
      <?php
   $header_content = get_sub_field('header_content');
   echo "<p>".$header_content."</p>";

   ?>
  </div>
  <div class="left">
<div class="salesforce-contact-form" itemscope itemtype="http://schema.org/Contact">
  <form class="contact-form">
            <div class="form-group">

            <select name="Department" class="form-control" required itemprop="department">
        				<option value="">SELECT DEPARTMENT</option>
        				<option value="Sales">Sales</option>
        				<option value="Marketing">Marketing/PR</option>
        				<option value="Finance">Finance</option>
        				<option value="IT">IT</option>
        				<option value="HR">HR</option>
        				<option value="Recruitment">Recruitment</option>
        				<option value="Other">Other</option>
			      </select>
          </div>

       <div class="form-group">
         <input class="form-control" placeholder="First Name" type="text" name="FirstName" required itemprop="first name" />
       </div>

        <div class="form-group">
          <input class="form-control" placeholder="Last Name" type="text" name="LastName" required itemprop="lastname" />
        </div>

        <div class="form-group">
          <input class="form-control" placeholder="Email" type="email" name="Email" required itemprop="email" />
        </div>

        <div class="form-group">
          <input class="form-control" placeholder="Phone Number" type="text" name="Phone" itemprop="phone" />
        </div>

        <div class="form-group">
          <textarea class="form-control" placeholder="Message" name="Message" rows="10" itemprop="message" required></textarea>
        </div>

        <input type="submit" name="submit" class="submit" placeholder="Submit">

    </form>

    <div class="scf-thank-you" style="display:none">
		    <p>Thank you for contacting us.</p>
		    <p>Your message has been received and a member of the FDM team will be in touch shortly.</p>
	  </div>

  </div>
  </div>

  <div class="info">
    <?php
    $contact_info = get_sub_field('contact_info');
    echo "<p>".$contact_info."</p>";
     ?>

     <h4>Social Media</h4>

     <ul class="icon-effect">
       <a href="#"><li class="link-fb"><i class="fab fa-facebook-f" aria-hidden="true"></i><span class="label fb">Facebook</span></li></a>
       <a href="#"><li class="link-twitter"><i class="fab fa-twitter"></i><span class="label twitter">Twitter</span></li></a>
       <a href="#"><li class="link-in"><i class="fab fa-linkedin"></i><span class="label in">linkedin</span></li></a>
     </ul>

    <div class="button">
     <h4>Ready to join our Careers Programme?</h4>
     <a href="#" class="apply">APPLY ></a>
   </div>
  </div>
</div>
