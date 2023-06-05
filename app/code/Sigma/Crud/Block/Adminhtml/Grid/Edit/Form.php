<?php

namespace Sigma\Crud\Block\Adminhtml\Grid\Edit;

use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Cms\Model\Wysiwyg\Config;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Registry;
use Sigma\CrudAssignment\Model\Status;

class Form extends Generic
{
    public function __construct(
        Context     $context,
        Registry    $registry,
        FormFactory $formFactory,
        private Config $config,
        private Status $status,
        array       $data = []
    )
    {
        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _prepareForm()
    {
       $dataFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
       $model = $this->_coreRegistry->registry('row_data');
       $form = $this->_formFactory->create(
           ['data' => [
                       'id' => 'edit_form',
                       'enctype' => 'multipart/form-data',
                       'action' => $this->getData('action'),
                       'method' => 'post'
                      ]
           ]
       );

        $form->setHtmlIdPrefix('argrid_');

        if($model->getId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Row data'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Row Data'), 'class' => 'fieldset-wide']
            );
        }

        $fieldset->addField(
            'name',
            'text',
            [
                'name' => 'name',
                'label' => __('Name'),
                'id' => 'name',
                'title' => __('Name'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );
        $wysiwygConfig = $this->config->getConfig(['tab_id' => $this->getTabId()]);
        $fieldset->addField(
            'email',
            'text',
            [
                'name' => 'email',
                'label' => __('Email'),
                'required' => true,
            ]
        );

        $fieldset->addField(
            'contact_number',
            'text',
            [
                'name' => 'contact_number',
                'label' => __('Contact Number'),
                'id' => 'contact_number',
                'title' => __('Contact Number'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );

        $fieldset->addField(
            'message',
            'textarea',
            [
                'name' => 'message',
                'label' => __('Message'),
                'id' => 'title',
                'title' => __('Message'),
                'class' => 'required-entry',
                'required' => true,
                'config' => $wysiwygConfig
            ]
        );

        $fieldset->addField(
            'created_at',
            'date',
            [
                'name' => 'created_at',
                'label' => __('Creation Date'),
                'date_format' => $dataFormat,
                'time_format' => 'HH:mm:ss',
                'class' => 'validate-date validate-date-range date-range-custom_theme-from',
                'class' => 'required-entry',
                'style' => 'width:200px',
            ]
        );

        $fieldset->addField(
            'updated_at',
            'date',
            [
                'name' => 'updated_at',
                'label' => __('Update Date'),
                'date_format' => $dataFormat,
                'time_format' => 'HH:mm:ss',
                'class' => 'validate-date validate-date-range date-range-custom_theme-from',
                'class' => 'required-entry',
                'style' => 'width:200px',
            ]
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
