<?php
/**
 * Template Name: Sell your Car 
 */
?>
<?php session_start();
$k = 0;

if (isset($_POST['submit3']) && $_POST['submit3'] == 'Submit') {
  if ($_SESSION['security_code3'] == $_POST['security_code3'] && !empty($_SESSION['security_code3'])) {
    unset($_SESSION['security_code3']);
    $errors['security_code3'] = '';
  }
  else {
    $errors['security_code3'] = __('Incorrect Security Code','language');
    echo '<script>alert("Incorrect Security Code. \nPlease re-enter correct text and try again.");</script>';
    $hasError = TRUE;
  }
}

if (isset($_POST['ptitle']) && $k == 0 && $errors['security_code3'] == '') {
  if (isset($_POST['num']) != $_SESSION ['img_number']) {
    $k = 1;
  }
  else {
    $user_name = sanitize_text_field($_POST["fname"]) . sanitize_text_field($_POST["lname"]);
    $user_email = sanitize_email($_POST["email"]);
    $user_id = username_exists($user_name);

    if (!$user_id) {
      $random_password = wp_generate_password(12, FALSE);
      $user_id = wp_create_user($user_name, $random_password, $user_email);
    }
    else {
      $random_password = __('User already exists.  Password inherited.', 'language');
    }

    $data['post_title'] = sanitize_text_field($_POST['ptitle']);
    $data['post_status'] = 'pending';
    $data['post_author'] = $user_id;
    $data['post_type'] = 'user_listing';
    $post_id = wp_insert_post($data);

    $mod1_arr = array(
      "price" => sanitize_text_field($_POST['price']),
      "vehicletype" => sanitize_text_field($_POST['vehitype']),
      "year" => sanitize_text_field($_POST['yearbuilt']),
      "miles" => sanitize_text_field($_POST['mileage']),
      "drive" => sanitize_text_field($_POST['vdrive']),
      "exterior" => sanitize_text_field($_POST['ext']),
      "interior" => sanitize_text_field($_POST['int']),
      "vin" => sanitize_text_field($_POST['vin']),
    );

    $commet_arr = array(
      'comment_area' => sanitize_text_field($_POST['description']),
    );

    add_post_meta($post_id, "mod1", $mod1_arr);
    add_post_meta($post_id, "mod3", $commet_arr);
    add_post_meta($post_id, "_price", sanitize_text_field($_POST["price"]));
    add_post_meta($post_id, "_fname", sanitize_text_field($_POST["fname"]));
    add_post_meta($post_id, "_lname", sanitize_text_field($_POST["lname"]));
    add_post_meta($post_id, "_email", sanitize_email($_POST["email"]));
    add_post_meta($post_id, "_phone", sanitize_text_field($_POST["pnum"]));

    $makemodel = array(
      sanitize_text_field($_POST['model']),
      sanitize_text_field($_POST['make']),
    );

    wp_set_object_terms($post_id, $makemodel, 'makemodel');

    $arrtmp = explode(',', sanitize_text_field($_POST['features']));

    wp_set_object_terms($post_id, $arrtmp, 'features');

    $t = intval($_POST['tid']) + 1;

    for ($i = 0; $i < $t; $i++) {
      if ($_FILES['input_' . $i]['name'] != '') {
        $wp_filetype = wp_check_filetype(basename($_FILES["input_" . $i]["name"]), NULL);
        $sPattern = '/\s*/m';
        $sReplace = '';
        $f = $_FILES["input_" . $i]["name"];
        $n = explode('.', $f);

        include_once(ABSPATH . 'wp-admin/includes/image.php');

        $filename = $_FILES["input_" . $i]["name"];
        $name = preg_replace($sPattern, $sReplace, $filename);

        //$emailname = preg_replace('/^[A-Za-z][A-Za-z0-9!@#$%^&*]*$/','-',$filename);
        $emailname = preg_replace('/(JPG|JPEG|jpg|jpeg|gif|png|bmp|tif|tiff)/', '', $filename);
        $emailname = str_replace(".", "-", $emailname);
        $emailname = preg_replace('/\s*/m', '', $emailname);
        //$emailname = strtolower($emailname);

        $upload_path = wp_upload_dir();
        move_uploaded_file($_FILES['input_' . $i]['tmp_name'], $upload_path['path'] . '/' . $name);
        $pathurl = $upload_path['url'];
        $attachment = array(
          'post_mime_type' => $wp_filetype['type'],
          'post_title' => preg_replace('/\.[^.]+$/', '', basename($_FILES["input_" . $i]["name"])),
          'post_content' => '',
          'post_status' => 'inherit'
        );

        $attach_id = wp_insert_attachment($attachment, $upload_path['path'] . '/' . $name, $post_id);
        $allimgarr[] = $upload_path['url'] . '/' . $emailname . '86x60.' . strtolower($n[1]);
        $attach_data = wp_generate_attachment_metadata($attach_id, $upload_path['path'] . '/' . $name);
        wp_update_attachment_metadata($attach_id, $attach_data);
      }
    }

    $tmpURL = $_SERVER['SERVER_NAME'] . $_SERVER['REDIRECT_URL'];
    $msgstr = '';

    if (isset($_POST['fname'])) {
      $msgstr .= '<br/><tr><td><br/>'.__('Your Personal Information','language').'<br/><br/></td></tr><tr><td><span style="font-weight:bold!important">'.__('First Name:','language').'</span></td><td>' . sanitize_text_field($_POST["fname"]) . '</td></tr>';
    }

    if (isset($_POST['lname'])) {
      $msgstr .= '<tr><td><span style="font-weight:bold!important">'.__('Last Name:','language').'</span></td><td>' . sanitize_text_field($_POST["lname"]) . '</td></tr>';
    }

    if (isset($_POST['email'])) {
      $msgstr .= '<tr><td><span style="font-weight:bold!important">'.__('E-mail:','language').'</span></td><td>' . sanitize_email($_POST["email"]) . '</td></tr>';
    }

    if (isset($_POST['pnum'])) {
      $msgstr .= '<tr><td><span style="font-weight:bold!important">'.__('Phone Number:','language').'</span></td><td>' . sanitize_text_field($_POST["pnum"]) . '</td></tr>';
    }

    ?>
    <?php

    $str = '<table><tr><tr><td><span style="font-weight:bold!important">'.__('Title: ','language').'</span></td><td style="margin-left:10px;">' . ' ' . sanitize_text_field($_POST["ptitle"]) . '</td></tr>
            <tr><td><span style="font-weight:bold!important">' . $options['vehicle_type_text'] . ': </strong></td><td>' . sanitize_text_field($_POST["vehitype"]) . '</td></tr>
            <tr><td><span style="font-weight:bold!important">' . $options['price_text'] . ': </span></td><td>' . sanitize_text_field($_POST["price"]) . '</td></tr>
            <tr><td><span style="font-weight:bold!important">' . $options['year_text'] . ': </span></td><td> ' . sanitize_text_field($_POST["yearbuilt"]) . '</td></tr>
            <tr><td><span style="font-weight:bold!important">' . $options['drive_text'] . ': </span></td><td> ' . sanitize_text_field($_POST["vdrive"]) . '</td></tr>
            <tr><td><span style="font-weight:bold!important">' . $options['miles_text'] . ': </span></td><td>' . sanitize_text_field($_POST["mileage"]) . '</td></tr>
            <tr><td><span style="font-weight:bold!important">' . $options['exterior_text'] . ': </span></td><td>' . sanitize_text_field($_POST["ext"]) . '</td></tr>
            <tr><td><span style="font-weight:bold!important">' . $options['interior_text'] . ': </span></td><td>' . sanitize_text_field($_POST["int"]) . '</td></tr>
            <tr><td><span style="font-weight:bold!important">' . $options['vin_text'] . ': </span></td><td>' . sanitize_text_field($_POST["vin"]) . '</td></tr>
            <tr><td><span style="font-weight:bold!important">' . $options['transmission_text'] . ': </span></td><td>' . sanitize_text_field($_POST["transm"]) . '</td></tr>
            </tr><br/>' . $msgstr . '</table>' . $imgmsg;
    $from = get_bloginfo('admin_email');
    $headers = "MIME-Version: 1.0" . "\n";
    $headers .= "Content-type:text/html;charset=utf-8" . "\n";
    $headers .= "From: $from" . "\n";
    $wp_user_search = $wpdb->get_results("SELECT ID, display_name FROM $wpdb->users ORDER BY ID");

    foreach ($wp_user_search as $user) {
      if (!get_the_author_meta('emailmsg', $user->ID)) {
        echo '';
      }
      else {
        $email_id = get_the_author_meta('user_email', $user->ID);
        wp_mail($email_id, 'New listing from ' . get_bloginfo('name'), $str, $headers);
      }
    }

    if (isset($_POST['sendcopy'])) {
      $email_id = sanitize_email($_POST['email']);
      wp_mail($email_id, 'New listing submission from ' . bloginfo('name') . '', $str, $headers);
    }

    $k = 2;
  }
}

?>

<?php get_header(); ?>

<?php
global $options;
$fields;
$options2;
$options3;
$symbols;

$fields = get_post_meta($post->ID, 'mod1', TRUE);
$options2 = get_post_meta($post->ID, 'mod2', TRUE);
$options3 = get_post_meta($post->ID, 'mod3', TRUE);
$symbols = get_option('gorilla_symbols');
$options = my_get_theme_options();
?>

<div class="form twelve columns">
<div id="layer"></div>
<div id="content-single">
<?php cps_ajax_search_results(); ?>

<div class="hideOnSearch" style="border:none!important">
<div class="blog-post-form hideOnSearch" style="border:none!important">
<h1>
  <?php _e('Submit your Vehicle to', 'language'); ?>
  <?php bloginfo('name'); ?>
</h1>
<?php include_once(TEMPLATEPATH . "/includes/validation.php"); ?>
<?php if ($k == 2) { ?>

  <!-- Thank you Message -->

  <div class="thankyou_page">
    <div style=" width:100%;color: #000000" id="cdError">
      <p>
        <?php _e('Thank you ', 'language'); ?>
        <span
          style="font-weight:bold!important"><?php echo sanitize_text_field($_POST['fname']) . ' '; ?></span><span
          style="font-weight:bold!important"><?php echo sanitize_text_field($_POST['lname']); ?></span><?php echo ','; ?> <?php echo _e('your vehicle was added successfully and it will be reviewed for publishing, you will receive an e-mail when the listing goes live and we will e-mail a password for you to edit your vehicle listing in our inventory.', 'language'); ?>
      </p>
      <br/>

      <p><?php echo _e('This is a summary of your submitted listing.', 'language'); ?></p>
      <?php



      $str = '<table><tr><tr><td>' . $options['make_model_text'] . ': </td><td>' . sanitize_text_field($_POST["make"]) . ' ' . sanitize_text_field($_POST["model"]) . '</td></tr>
          <tr><td><span style="font-weight:bold!important">' . __('Listing Title:', 'language') . '</span></td><td>' . sanitize_text_field($_POST["ptitle"]) . '</td></tr>
            <tr><td><span style="font-weight:bold!important">' . $options['vehicle_type_text'] . ': </span></td><td>' . sanitize_text_field($_POST["vehitype"]) . '</td></tr>
            <tr><td><span style="font-weight:bold!important">' . $options['price_text'] . ': </span></td><td> ' . sanitize_text_field($_POST["price"]) . '</td></tr>
            <tr><td><span style="font-weight:bold!important">' . $options['year_text'] . ': </span></td><td>' . sanitize_text_field($_POST["yearbuilt"]) . '</td></tr>
            <tr><td><span style="font-weight:bold!important">' . $options['miles_text'] . ': </span></td><td>' . sanitize_text_field($_POST["mileage"]) . '</td></tr>
            <tr><td><span style="font-weight:bold!important">' . $options['drive_text'] . ': </span></td><td>' . sanitize_text_field($_POST["vdrive"]) . '</td></tr>
            <tr><td><span style="font-weight:bold!important">' . $options['exterior_text'] . ': </span></td><td>' . sanitize_text_field($_POST["ext"]) . '</td></tr>
            <tr><td><span style="font-weight:bold!important">' . $options['interior_text'] . ': </span></td><td>' . sanitize_text_field($_POST["int"]) . '</td></tr>
            <tr><td><span style="font-weight:bold!important">' . $options['vin_text'] . ': </span></td><td>' . sanitize_text_field($_POST["vin"]) . '</td></tr>
            <tr><td><span style="font-weight:bold!important">' . $options['transmission_text'] . ': </span></td><td>' . sanitize_text_field($_POST["transm"]) . '</td></tr>
            </tr>' . $msgstr . '</table>';/* .$imgmsg; */
      ?>
      <?php echo $str; ?> </div>
  </div>

  <!-- End Thank you Message -->

<?php }
else { ?>
  <form action="" id="pro_form" enctype="multipart/form-data" method="post">

  <!-- Wrong Verification Code Message -->

  <div>
  <?php if ($k == 1) { ?>
    <div style=" width:100%;color:#CC0033; " id="cdError">
      <?php _e('Your verification code is wrong', 'language'); ?>
    </div>
  <?php } ?>

  <!-- End Wrong Verification Code Message -->
  <div style="clear:both"></div>

  <div class="pro_fields">
    <li>
      <label class="head_label">
        <?php _e('Your Vehicle Information &raquo;', 'language'); ?>
      </label>
    </li>
  </div>

  <!-- Make & Model Field -->

  <div class="pro_fields">
    <div class="title_field">
      <label class="field_label">
        <?php _e('Your listing title', 'language'); ?>
      </label>
      <?php $ptitle = sanitize_text_field($_POST['ptitle']);
      if ($ptitle != '' && $ptitle != __('First Name','language')) {
        $ptitle = sanitize_text_field($_POST['ptitle']);
      }
      else {
        $ptitle = __('Enter listing title','language');
      }
      ?>
      <div>
        <input type="text"
               onblur="if(this.value == '') { { this.value = '<?php _e('Enter listing title','language'); ?>';}" 
               onfocus="if(this.value == '<?php _e('Enter listing title','language'); ?>') { this.value = ''; }"
               value="<?php echo $ptitle; ?>" class="submit_form_long_input"
               style="width: 388px;" autocomplete="off" id="ptitle"
               name="ptitle">
      </div>
    </div>
    <div style="clear:both"></div>
  </div>
  <div class="pro_fields">
  <div class="make_model_field">
    <li class="class=" drop_single>
      <label class="field_label">
        <?php _e('Make', 'language'); ?>
      </label>

      <div>
        <script type="text/javascript">
          $(function () {
            $('#make_form').change(function () {
              var $mainCat = $('#make_form :selected').attr('data-value');
              if (!$mainCat) {
                $mainCat = $('#make_form').val();
              }

              // call ajax
              $("#model_form").empty();
              $.ajax({
                url: "<?php bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php",
                type: 'POST',
                data: 'action=call_form&main_catid=' + $mainCat,
                success: function (results) {
                  options = $(results);

                  if (options.length > 1) {
                    $("#model_form").removeAttr("disabled");
                  }
                  else {
                    if (!$("#model_form").is(':disabled')) {
                      $("#model_form").attr("disabled", "disabled");
                    }
                  }

                  $("#model_form").append(results);
                  $("#model_form").selectBox('destroy');
                  $("#model_form").selectBox();
                }
              });
            });
          });
        </script>

        <?php

        wp_dropdown_categories_custom(array(
          'show_count' => '1',
          'selected' => '1',
          'hierarchical' => '1',
          'depth' => '1',
          'hide_empty' => '0',
          'exclude' => '1',
          'class' => 'dropdown',
          'show_option_none' =>  __('Select Make','language'),
          'name' => 'make_form',
          'id' => 'make_form',
          'taxonomy' => 'makemodel',
          'walker' => new Walker_CategoryDropdown_Custom(),
        ));?>
      </div>
    </li>
  </div>
  <div class="make_model_field">
    <li class="class=" drop_single>
      <label class="field_label">
        <?php _e('Model', 'language'); ?>
      </label>
      <label class="field_label">
        <?php _e(' (select make first)', 'language'); ?>
      </label>

      <div>
        <select name="model_form" id="model_form" class="dropdown" disabled="disabled">
          <option value="">
            <?php _e('Select Model', 'language'); ?>
          </option>
        </select>
      </div>
    </li>
  </div>

  <!-- Make & Model Field -->

  <div class="year_field">
    <li class="drop_single">
      <label class="field_label"><?php echo $options['year_text']; ?></label>

      <div>
        <?php global $post, $wpdb, $meta_boxes, $mod1;

        $output = '';

        foreach ($meta_boxes as $meta_box) {

          $data = get_post_meta($post->ID, $mod1, TRUE);

          if (($meta_box['name'] == 'year') && (!empty($meta_box['options']))) { // dropdown lists

            $output .= '<select class="dropdown" id="yearbuilt" name="yearbuilt">';

            if (isset($data[$meta_box['name']])) {

              $output .= '<option value="0">Select</option>';

            }

            foreach ($meta_box['options'] as $dropdown_key => $dropdown_value) {

              if ($dropdown_value == sanitize_text_field($_POST['yearbuilt'])) {
                $output .= '<option value="' . $dropdown_value . '" SELECTED>' . $dropdown_value . '</option>';
              }
              else {
                $output .= '<option value="' . $dropdown_value . '">' . $dropdown_value . '</option>';
              }

            }

            $output .= '</select>';

          }

        }

        echo $output;

        ?>
      </div>
    </li>
  </div>
  <div style="clear:both"></div>
  </div>
  <div class="pro_fields">
    <div class="price_field">
      <label class="field_label"><?php echo $options['price_text']; ?></label>
      <?php $price = sanitize_text_field($_POST['price']);
      if ($price != '' && $price != __('Enter vehicle price','language')) {
        $price = sanitize_text_field($_POST['price']);
      }
      else {
        $price = __('Enter vehicle price','language');
      }
      ?>
      <div style="width: 200px;">
        <input type="text"
               onblur="if(this.value == '') { this.value = '<?php _e('Enter vehicle price','language'); ?>'; }"
               onfocus="if(this.value == '<?php _e('Enter vehicle price','language'); ?>') { this.value = ''; }"
               value="<?php echo $price; ?>" style="width: 200px;"
               autocomplete="off" class="default" id="price" name="price">
      </div>
    </div>
    <div class="miles_field">
      <label class="field_label"><?php echo $options['miles_text']; ?></label>
      <?php $mileage = sanitize_text_field($_POST['mileage']);
      if ($mileage != '' && $mileage != __('Enter vehicle miles','language')) {
        $mileage = sanitize_text_field($_POST['mileage']);
      }
      else {
        $mileage = 'Enter vehicle miles';
      }
      ?>
      <div style="width: 200px;">
        <input
          onblur="if(this.value == '') { this.value = 'Enter vehicle miles'; }"
          onfocus="if(this.value == '<?php _e('Enter vehicle miles','language');?>') { this.value = ''; }"
          type="text" style="width: 200px;" autocomplete="off" id="mileage"
          value="<?php echo $mileage; ?>" name="mileage">
      </div>
    </div>
    <div style="clear:both"></div>
  </div>
  <div class="pro_fields">
    <div class="ext_field">
      <label class="field_label"><?php echo $options['exterior_text']; ?></label>
      <?php $ext1 = sanitize_text_field($_POST['ext']);
      if ($ext1 != '' && $ext1 != __('Enter exterior color','language')) {
        $ext1 = sanitize_text_field($_POST['ext']);
      }
      else {
        $ext1 = __('Enter exterior color','language');
      }
      ?>
      <div style="width: 200px;">
        <input type="text"
               onblur="if(this.value == '') { this.value = '<?php _e('Enter exterior color','language');?>'; }"
               onfocus="if(this.value == __('Enter exterior color','language')) { this.value = ''; }"
               value="<?php echo $ext1; ?>" style="width: 200px;"
               autocomplete="off" class="default" id="ext" name="ext">
      </div>
    </div>
    <div class="int_field">
      <label class="field_label"><?php echo $options['interior_text']; ?></label>
      <?php $int1 = sanitize_text_field($_POST['int']);
      if ($int1 != '' && $int1 != __('Enter interior color','language')) {
        $int1 = sanitize_text_field($_POST['int']);
      }
      else {
        $int1 = __('Enter interior color','language');
      }
      ?>
      <div style="width: 200px;">
        <input
          onblur="if(this.value == '') { this.value = __('Enter interior color','language'); }"
          onfocus="if(this.value == '<?php _e('Enter interior color','language');?>') { this.value = ''; }"
          value="<?php echo $int1; ?>" type="text" style="width: 180px;"
          autocomplete="off" id="int" name="int">
      </div>
    </div>
    <div class="drive_field">
      <label class="field_label"><?php echo $options['drive_text']; ?></label>
      <?php $vdrive = sanitize_text_field($_POST['vdrive']);
      if ($vdrive != '' && $vdrive != __('Enter vehicle drive','language')) {
        $vdrive = sanitize_text_field($_POST['vdrive']);
      }
      else {
        $vdrive = __('Enter vehicle drive','language');
      }
      ?>
      <div style="width: 100px;">
        <input
          onblur="if(this.value == '') { this.value = '<?php _e('Enter vehicle drive','language');?>'; }"
          onfocus="if(this.value == '<?php _e('Enter vehicle drive','language');?>') { this.value = ''; }"
          value="<?php echo $vdrive; ?>" type="text" style="width: 120px;"
          autocomplete="off" id="vdrive" name="vdrive">
      </div>
    </div>
    <div style="clear:both"></div>
  </div>
  <div class="pro_fields">
    <div class="vin_field">
      <label class="field_label"><?php echo $options['vin_text']; ?></label>
      <?php $vin = sanitize_text_field($_POST['vin']);
      if ($vin != '' && $vin != __('Enter VIN','language')) {
        $vin = sanitize_text_field($_POST['vin']);
      }
      else {
        $vin = 'Enter VIN Number';
      }
      ?>
      <div style="width: 204px;">
        <input
          onblur="if(this.value == '') { this.value = '<?php _e('Enter VIN','language');?>'; }"
          onfocus="if(this.value == __('Enter VIN','language')) { this.value = ''; }"
          value="<?php echo $vin; ?>" type="text" style="width: 184px;"
          autocomplete="off" class="default" id="vin" name="vin">
      </div>
    </div>
    <div class="features_field">
      <label class="field_label"><?php echo $options['features_text']; ?></label>

      <div class="fourHundredWidth">
        <?php $features = sanitize_text_field($_POST['features']);
        if ($features != '' && $features != __('Separate features with commas (feature1, feature2, feature3)','language')) {
          $features = sanitize_text_field($_POST['features']);
        }
        else {
          $features = __('Separate features with commas (feature1, feature2, feature3)','language');
        }
        ?>
        <input type="text" class="submit_form_long_input" style="width: 390px;"
               autocomplete="off" class="default" id="features" name="features"
               onblur="if(this.value == '') { this.value = '<?php _e('Separate features with commas (feature1, feature2, feature3)','language');?>'; }"
               
               onfocus="if(this.value == '<?php _e('Separate features with commas (feature1, feature2, feature3)','language');?>') { this.value = ''; }"
               value="<?php echo $features; ?>">
      </div>
    </div>
    <div style="clear:both"></div>
  </div>

  <!-- End Taxonomies -->

  <div class="pro_fields">
    <div class="transmission_field">
      <li class="drop_single">
        <label
          class="field_label"><?php echo $options['transmission_text']; ?></label>

        <div>
          <select class="dropdown" name="transm" id="transm">
            <option value="0">
              <?php _e('Select', 'language'); ?>
            </option>
            <?php
            if ($_POST['transm'] == $options['transmission_1']) {
              $transmissionoption1 = 'SELECTED';
            }
            if ($_POST['transm'] == $options['transmission_2']) {
              $transmissionoption2 = 'SELECTED';
            }
            if ($_POST['transm'] == $options['transmission_3']) {
              $transmissionoption3 = 'SELECTED';
            }
            if ($_POST['transm'] == $options['transmission_4']) {
              $transmissionoption4 = 'SELECTED';
            }
            ?>
            <option
              value="<?php echo $options['transmission_1']; ?>" <?php echo $transmissionoption1; ?>><?php echo $options['transmission_1']; ?></option>
            <option
              value="<?php echo $options['transmission_2']; ?>" <?php echo $transmissionoption2; ?>><?php echo $options['transmission_2']; ?></option>
            <option
              value="<?php echo $options['transmission_3']; ?>" <?php echo $transmissionoption3; ?>><?php echo $options['transmission_3']; ?></option>
            <option
              value="<?php echo $options['transmission_4']; ?>" <?php echo $transmissionoption4; ?>><?php echo $options['transmission_4']; ?></option>
          </select>
        </div>
      </li>
    </div>
    <div class="transmission_field">
      <li class="drop_single">
        <label
          class="field_label"><?php echo $options['vehicle_type_text']; ?></label>

        <div>
          <select class="dropdown" name="vehitype" id="vehitype">
            <option value="0">
              <?php _e('Select', 'language'); ?>
            </option>
            <?php
            if ($_POST['vehitype'] == $options['vehicle_type_1']) {
              $vehicletype1 = 'SELECTED';
            }
            if ($_POST['vehitype'] == $options['vehicle_type_2']) {
              $vehicletype2 = 'SELECTED';
            }
            if ($_POST['vehitype'] == $options['vehicle_type_3']) {
              $vehicletype3 = 'SELECTED';
            }
            if ($_POST['vehitype'] == $options['vehicle_type_4']) {
              $vehicletype4 = 'SELECTED';
            }
            if ($_POST['vehitype'] == $options['vehicle_type_5']) {
              $vehicletype5 = 'SELECTED';
            }
            if ($_POST['vehitype'] == $options['vehicle_type_6']) {
              $vehicletype6 = 'SELECTED';
            }
            if ($_POST['vehitype'] == $options['vehicle_type_7']) {
              $vehicletype7 = 'SELECTED';
            }
            if ($_POST['vehitype'] == $options['vehicle_type_8']) {
              $vehicletype8 = 'SELECTED';
            }
            if ($_POST['vehitype'] == $options['vehicle_type_9']) {
              $vehicletype9 = 'SELECTED';
            }
            if ($_POST['vehitype'] == $options['vehicle_type_10']) {
              $vehicletype10 = 'SELECTED';
            }
            if ($_POST['vehitype'] == $options['vehicle_type_11']) {
              $vehicletype11 = 'SELECTED';
            }
            if ($_POST['vehitype'] == $options['vehicle_type_12']) {
              $vehicletype12 = 'SELECTED';
            }

            ?>
            <option
              value="<?php echo $options['vehicle_type_1']; ?>" <?php echo $vehicletype1; ?>><?php echo $options['vehicle_type_1']; ?></option>
            <option
              value="<?php echo $options['vehicle_type_2']; ?>" <?php echo $vehicletype2; ?>><?php echo $options['vehicle_type_2']; ?></option>
            <option
              value="<?php echo $options['vehicle_type_3']; ?>" <?php echo $vehicletype3; ?>><?php echo $options['vehicle_type_3']; ?></option>
            <option
              value="<?php echo $options['vehicle_type_4']; ?>" <?php echo $vehicletype4; ?>><?php echo $options['vehicle_type_4']; ?></option>
            <option
              value="<?php echo $options['vehicle_type_5']; ?>" <?php echo $vehicletype5; ?>><?php echo $options['vehicle_type_5']; ?></option>
            <option
              value="<?php echo $options['vehicle_type_6']; ?>" <?php echo $vehicletype6; ?>><?php echo $options['vehicle_type_6']; ?></option>
            <option
              value="<?php echo $options['vehicle_type_7']; ?>" <?php echo $vehicletype7; ?>><?php echo $options['vehicle_type_7']; ?></option>
            <option
              value="<?php echo $options['vehicle_type_8']; ?>" <?php echo $vehicletype8; ?>><?php echo $options['vehicle_type_8']; ?></option>
            <option
              value="<?php echo $options['vehicle_type_9']; ?>" <?php echo $vehicletype9; ?>><?php echo $options['vehicle_type_9']; ?></option>
            <option
              value="<?php echo $options['vehicle_type_10']; ?>" <?php echo $vehicletype10; ?>><?php echo $options['vehicle_type_10']; ?></option>
            <option
              value="<?php echo $options['vehicle_type_11']; ?>" <?php echo $vehicletype11; ?>><?php echo $options['vehicle_type_11']; ?></option>
            <option
              value="<?php echo $options['vehicle_type_12']; ?>" <?php echo $vehicletype12; ?>><?php echo $options['vehicle_type_12']; ?></option>
          </select>
        </div>
      </li>
    </div>
    <div style="clear:both"></div>
  </div>

  <!-- End Taxonomies -->

  <!-- Description -->

  <div class="pro_fields">
    <li>
      <label class="field_label"><?php echo $options['description_text']; ?></label>

      <div>
        <textarea cols="50" rows="10" class="textarea medium"
                  name="description"><?php echo sanitize_text_field($_POST['description']); ?></textarea>
      </div>
    </li>
  </div>

  <!-- End Description -->

  <!-- Property Images -->

  <div class="pro_fields">
    <li class="upload_file">
      <label class="field_label">
        <?php _e('Property Photos', 'language'); ?>
      </label>

      <div><br/>
                  <span class="photos_text">
                  <input type="hidden" name="tid" id="tid"/>
                  <div id="parah">
                    <div class="upload">
                      <?php _e('Upload Photo 1 ', 'language'); ?>
                      <br>
                      <input type="file" name="input_0">
                    </div>
                    <br/>
                  </div>
                  <a href="javascript:void(0)" onclick="addInput('parah')">
                    <?php _e('More photos', 'language'); ?>
                  </a> </span></div>
    </li>
    <li class="upload_desc">
      <p>
        <?php _e('Click the "More photos" link to add all your images, all photos will be automatically resized to fit the property listing layout. We recommend that you upload photos in full resolution for better results.', 'language'); ?>

      <p>
    </li>
    <div style="clear:both;"></div>
  </div>

  <!-- End Property Images -->

  <!-- Description -->

  <div class="pro_fields">
    <li>
      <label class="head_label">
        <?php _e('Personal Information &raquo;', 'language'); ?>
      </label>
    </li>
  </div>

  <!-- End Description -->

  <!-- Personal Info -->

  <div class="pro_fields">
    <div class="fname_field">
      <label class="field_label">
        <?php _e('First name', 'language'); ?>
      </label>
      <?php $fname = sanitize_text_field($_POST['fname']);
      if ($fname != '' && $fname != __('Enter your first name','language')) {
        $fname = sanitize_text_field($_POST['fname']);
      }
      else {
        $fname = __('Enter your first name','language');
      }
      ?>
      <div style="width: 270px;">
        <input type="text" style="width: 250px;" autocomplete="off"
               class="default" id="fname" name="fname"
               onblur="if(this.value == '') { this.value = '<?php _e('Enter your first name','language');?>'; }"
               onfocus="if(this.value == '<?php _e('Enter your first name','language');?>') { this.value = ''; }"
               value="<?php echo $fname; ?>">
      </div>
    </div>
    <div class="lname_field">
      <label class="field_label">
        <?php _e('Last name', 'language'); ?>
      </label>
      <?php $lname = sanitize_text_field($_POST['lname']);
      if ($lname != '' && $lname !=  __('Enter your last name','language')) {
        $lname = sanitize_text_field($_POST['lname']);
      }
      else {
        $lname = __('Enter your last name','language');
      }
      ?>
      <div>
        <div style="width: 260px;">
          <input type="text" style="width: 250px;" autocomplete="off"
                 class="default" id="lname" name="lname"
                 onblur="if(this.value == '') { this.value = '<?php _e('Enter your last name','language');?>'; }"
                 onfocus="if(this.value == '<?php _e('Enter your last name','language');?>') { this.value = ''; }"
                 value="<?php echo $lname; ?>">
        </div>
        <div class="errr" id="PT"></div>
      </div>
    </div>
    <div style="clear:both"></div>
  </div>

  <!-- End Taxonomies -->

  <div id="submitsign">
    <div style="text-align:center;margin-top:-15px;">
      <?php _e('Uploading your Vehicle Information', 'language'); ?>
    </div>
    <img
      src="<?php bloginfo('template_url') ?>/images/common/submit-loader.gif"/>

    <div style="clear:both"></div>
              <span
                style="text-align:center;margin-top:0px;color:#666!important;">
              <?php _e('Please wait', 'language'); ?>
              </span></div>

  <!-- E-mail - Phone -->

  <div class="pro_fields">
    <div class="email_field">
      <label class="field_label">
        <?php _e('Email', 'language'); ?>
      </label>
      <?php $email = sanitize_email($_POST['email']);
      if ($email != '' && $email != __('Enter your E-mail','language')) {
        $email = sanitize_email($_POST['email']);
      }
      else {
        $email = __('Enter your E-mail','language');
      }
      ?>
      <div style="width: 270px;">
        <input
          onblur="if(this.value == '') { this.value = '<?php _e('Enter your E-mail','language');?>'; }"
          onfocus="if(this.value == '<?php _e('Enter your E-mail','language');?>') { this.value = ''; }"
          value="<?php echo $email; ?>" type="text" style="width: 250px;"
          autocomplete="off" class="default" id="email" name="email">
      </div>
    </div>
    <div class="phone_field">
      <label class="field_label">
        <?php _e('Phone number', 'language'); ?>
      </label>
      <?php $pnum = sanitize_text_field($_POST['pnum']);
      if ($pnum != '' && $pnum !=  __('Enter your phone number','language')) {
        $pnum = sanitize_text_field($_POST['pnum']);
      }
      else {
        $pnum = __('Enter your phone number','language');
      }
      ?>

      <div style="width: 260px;">
        <input
          onblur="if(this.value == '') { this.value = '<?php _e('Enter your phone number','language');?>'; }"
          onfocus="if(this.value == '<?php _e('Enter your phone number','language');?>') { this.value = ''; }"
          value="<?php echo $pnum; ?>" type="text" style="width: 250px;"
          autocomplete="off" class="default" id="pnum" name="pnum">
      </div>
    </div>
    <div style="clear:both"></div>
  </div>
  </div>

  <!-- End E-mail - Phone -->

  <!-- Start Send Copy -->

  <div class="pro_fields">
    <li>
      <label>
        <?php _e('Send copy to my email address', 'language'); ?>
      </label>
              <span>
              <?php $checked = "";
              if (isset($_POST['sendcopy'])) {
                $checked = "checked";
              } ?>
                <input type="checkbox" id="sendcopy"
                       name="sendcopy" <?php echo $checked; ?> />
              </span></li>
  </div>

  <!-- End Send Copy -->

  <!-- Start Captcha -->
  <div style="clear:both"></div>
  <div class="pro_fields">
    <li>
      <div class="captcha_form"> <span class="error">
                <?php $errors['security_code3']; ?>
                </span>

        <div class="securityText">
          <label>
            <?php _e('Security Text', 'language'); ?>
          </label>
        </div>
        <div class="securityImage1"><img
            src="<?php echo get_bloginfo('template_directory'); ?>/includes/captcha/CaptchaSecurityImages3.php?width=100&height=40&characters=5"/>
          <?php if ($errors['security_code3'] != '') { ?>
          <?php } ?>
        </div>
        <div class="clear"></div>
        <div class="securityCodeText">
          <label
            for="security_code"><?php _e('Security Code: ', 'language'); ?></label>
        </div>
        <div class="securityInputField">
          <input id="security_code3" name="security_code3"
                 value="<?php echo sanitize_text_field($_POST['security_code3']); ?>" type="text"/>
        </div>
        <div class="clear"></div>
      </div>
    </li>
  </div>

  <!-- End Captcha -->

  <div class="pro_fields">
    <li>
      <div
        style="width:30%!important;color:#CC0033;margin:0 auto;padding-right:20px;"
        id="cdError"></div>
      <div style="clear: both; margin: 16px 0 0;padding: 16px 0 10px;"
           class="searchsubmit">
        <input type="submit" id="submit3" name="submit3"
               onclick="return validation()" value="<?php _e('Submit','language');?>">
      </div>
    </li>
  </div>
  </form>
<?php } ?>
</div>
</div>
</div>
<div id="sidebar-search" > 
	<?php if ( !dynamic_sidebar( __('Search Module','language') ) ) : ?>
	<?php endif; ?>
				</div>
<div id="sidebar" class="common">
   <?php if ( !dynamic_sidebar( __('Sidebar','language') ) ) : ?>
  <?php endif; ?>
</div>
</div>
<div class="clearfix"></div>
</div>
<?php get_footer(); ?>
