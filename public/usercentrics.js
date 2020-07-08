"use strict";

jQuery(document).ready(function () {
  if (usercentrics.isInitialized) {
    init();
  } else {
    usercentrics.onViewInit = function () {
      return init();
    };
  }

  function init() {
    var iframes = document.querySelectorAll('iframe[uc-custom-src]');
    var consents = usercentrics.getConsents();
    iframes.forEach(function (iframe) {
      var $iframe = $(iframe);
      var dataProcessingService = iframe.dataset['usercentrics'];

      if (!dataProcessingService) {
        console.error('Missing data-usercentrics for iframe', iframe);
        return;
      }

      var $embeddingContainer = $iframe.next('.uc-embedding-container');
      if (!$embeddingContainer) {
        console.error('Missing uc-embedding-container for iframe', iframe);
        return;
      }

      var consent = consents.find(function (consent) {
        return consent.dataProcessingService === dataProcessingService;
      });

      if (!consent) {
        console.error('No usercentrics data processing service found for "' + dataProcessingService + '"', iframe);
        return;
      }

      if (consent.consentStatus === true) {
        iframe.setAttribute('src', iframe.getAttribute('uc-custom-src'));
        iframe.removeAttribute('uc-custom-src');
        $iframe.show();
        $embeddingContainer.hide();
      } else {
        $iframe.hide();
        $embeddingContainer.show();
        $embeddingContainer.find('.uc-embedding-more-info').off('click').click(function () {
          uc.ucapi.showInfoModal(consent.templateId);
          return false;
        });
        $embeddingContainer.find('.uc-embedding-accept').off('click').click(function () {
          uc.ucapi.setConsents([{'templateId': consent.templateId, 'status': true}]);
        });
      }
    });
    window.addEventListener('onConsentStatusChange', function (e) {
      if (e.event === 'consents_changed_finished') {
        location.reload();
      }
    });
  }
});
