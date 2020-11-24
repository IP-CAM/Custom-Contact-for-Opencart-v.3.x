<?php

class ControllerExtensionModuleContact extends Controller {

    public function index() {
        $this->load->language('extension/module/contact');

        $this->load->model('setting/setting');
        $this->document->setTitle($this->language->get('heading_title'));

        if(($this->request->server['REQUEST_METHOD'] == 'POST')) {
            $this->model_setting_setting->editSetting('module_contact', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
        }
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module/contact', '&user_token=' . $this->session->data['user_token'], true)
        );

        $data['action'] = $this->url->link('extension/module/contact', 'user_token=' . $this->session->data['user_token'], true);

        $data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

        if(isset($this->request->post['module_contact_status'])) {
            $data['module_contact_status'] = $this->request->post['module_contact_status'];
        } else {
            $data['module_contact_status'] = $this->config->get('module_contact_status');
        }

        if(isset($this->request->post['module_contact'])) {
            $data['module_contact'] = $this->request->post['module_contact'];
        } else {
            $data['module_contact'] = $this->config->get('module_contact');
        }
        if(isset($this->request->post['module_contact_description'])) {
            $data['module_contact_description'] = $this->request->post['module_contact_description'];
        } else {
            $data['module_contact_description'] = $this->config->get('module_contact_description');
        }

        $this->load->model('localisation/language');
        $data['languages']   = $this->model_localisation_language->getLanguages();
        $data['language_id'] = $this->config->get('config_language_id');



        $data['header']      = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer']      = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/contact', $data));
    }

    public function install() {
        
    }

}
