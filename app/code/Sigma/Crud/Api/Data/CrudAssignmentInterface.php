<?php

namespace Sigma\Crud\Api\Data;

interface CrudInterface
{
    const ID = 'id';
    const NAME = 'name';
    const CONTACT_NUMBER = 'contact_number';
    const MESSAGE = 'message';
    const UPDATE_TIME = 'updated_at';
    const CREATED_AT = 'created_at';


    /**
     * @return mixed
     */
    public function getId();

    /**
     * @param $id
     * @return mixed
     */
    public function setID($id);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param $name
     * @return mixed
     */
    public function setName($name);

    /**
     * @return mixed
     */
    public function getContactNumber();

    /**
     * @return mixed
     */
    public function setContactNumber($contact);


    /**
     * @return mixed
     */
    public function getMessage();

    /**
     * @param $message
     * @return mixed
     */
    public function setMessage($message);

    /**
     * @return mixed
     */
    public function getUpdateTime();

    /**
     * @param $updateTime
     * @return mixed
     */
    public function setUpdateTime($updateTime);

    /**
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * @param $createdAt
     * @return mixed
     */
    public function setCreatedAt($createdAt);

}
