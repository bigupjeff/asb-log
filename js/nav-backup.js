/**
 * File nav-backup.js.
 * ASB Log Theme
 * Handles back-to-top button functionality
 *
 * Author - Jefferson Real
 * URL - jeffersonreal.uk
 */

 /*Scroll to top when arrow up clicked BEGIN*/
 $(window).scroll(function() {
     var height = $(window).scrollTop();
     if (height > 100) {
         $('.nav_backup').fadeIn();
     } else {
         $('.nav_backup').fadeOut();
     }
 });
 $(document).ready(function() {
     $(".nav_backup").click(function(event) {
         event.preventDefault();
         $("html, body").animate({ scrollTop: 0 }, "slow");
         return false;
     });

 });
  /*Scroll to top when arrow up clicked END*/
