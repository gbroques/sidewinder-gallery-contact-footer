(function($) {
    $(document).ready(function() {
      var slider = $( "#mainindex" );
      slider.wrap(" <div id='gallery-contact-footer'></div> ");

      // Add social media icons
      var socialMediaIconsHtml = "<div id='footer-social-media-icons'><div class='footer-social-media-icons-wrapper'>";
      Object.keys(settings.social_media_icons).forEach(function(key, index) {
        if (typeof settings[key] === 'undefined' || settings[key] === '') {
          return;
        }
        var link = settings[key];
        if (key === 'email') {
          link = 'mailto:' + link;
        }
        socialMediaIconsHtml += '<a class="footer-social-media-icon" href="' + link + '" target="_blank">';
        socialMediaIconsHtml += settings.social_media_icons[key] + '</a>';
      });
      slider.before( socialMediaIconsHtml + "</div></div>" );

      // Add contact info
      var contactInfo = "<div id='footer-contact-info'>";
      if (typeof settings.phone_number !== 'undefined' && settings.phone_number !== '') {
        contactInfo += "<p>phone: " + settings.phone_number + "</p>";
      }

      if (typeof settings.email !== 'undefined' && settings.email !== '') {
        contactInfo += "<p>email: " + settings.email + "</p>";
      }

      slider.after( contactInfo + "</div>" );

      contactInfo = $('footer-contact-info');

      if (contactInfo.parent().is('.text-content')) {
        contactInfo.unwrap();
      }

    });
})(jQuery);