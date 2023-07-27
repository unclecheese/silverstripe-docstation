import jQuery from 'jquery';
import React from 'react';
import ReactDOM from 'react-dom';
import { loadComponent } from 'lib/Injector';

/**
 * Uses entwine to inject the HistoryViewer React component into the DOM, when used
 * outside of a React context e.g. in the CMS
 */
jQuery.entwine('ss', ($) => {
  $('.js-injector-boot .docstation-component').entwine({
    ReactRoot: null,
    onmatch() {
      let root = this.getReactRoot();
      if (!root) {
        root = ReactDOM.createRoot(this[0]);
      }
      const Component = loadComponent('Docstation');
      const dir = this.data('dir') || 'app/docs';
      root.render(
        <Component dir={dir} />,
        this[0]
      );
    },

    onunmatch() {
      const root = this.getReactRoot();
      if (root) {
        root.unmount();
        this.setReactRoot(null);
      }
    }
  });
});
