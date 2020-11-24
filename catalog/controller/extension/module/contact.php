<?php

class ControllerExtensionModuleContact extends Controller {

    public function index() {

        $this->load->model('tool/image');

        $this->document->addStyle('catalog/view/javascript/jquery/slick/slick.css');
        $this->document->addScript('catalog/view/javascript/jquery/slick/slick.js', 'footer');

        $module_contacts            = $this->config->get('module_contact');
        $module_contact_description = $this->config->get('module_contact_description');
        $language_id                = $this->config->get('config_language_id');
        $data                       = [
            'module_contacts'            => $module_contacts,
            'description' => $module_contact_description[$language_id],
        ];
        $data['breadcrumbs']        = array();

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home'),
            'separator' => false
        );
        $data['breadcrumbs'][] = array(
            'text' => html_entity_decode($module_contact_description[$language_id]['meta_h1']),
            'href' => $this->url->link('extension/module/about/info'),
        );

        $data['column_left']    = $this->load->controller('common/column_left');
        $data['column_right']   = $this->load->controller('common/column_right');
        $data['content_top']    = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer']         = $this->load->controller('common/footer');
        $data['header']         = $this->load->controller('common/header');
 

        $this->response->setOutput($this->load->view('extension/module/contact', $data));
    }

}
