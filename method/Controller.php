<?php

namespace method;

require_once $_SERVER['DOCUMENT_ROOT']."\\"."repository\AbstractController.php";
require_once $_SERVER['DOCUMENT_ROOT']."\\"."method\Request.php";
require_once $_SERVER['DOCUMENT_ROOT']."\\"."method\DatabaseManager.php";
require_once $_SERVER['DOCUMENT_ROOT']."\\"."method\Organization.php";
require_once $_SERVER['DOCUMENT_ROOT']."\\"."method\Department.php";
require_once $_SERVER['DOCUMENT_ROOT']."\\"."method\Participant.php";

use Repository\AbstractController;
use method\Request;
use method\DatabaseManager;
use method\Department;
use method\Organization;
use method\Participant;

Class Controller extends AbstractController{

    private $request;
    private $databaseManager;
    public $parent;
    public $parentId;


    public function __construct()
    {
        $this->request = new Request();
        $this->setBaseTemplate("\method\baseTemplate.php");
        $this->setOrganizationTemplate("\method\organizationTemplate.php");
        $this->setDepartmentTemplate("\method\departmentTemplate.php");
    }

    public function Redirect($template)
    {
        header("Location:".$template);
    }

    public function handleRequest()
    {
        $this->getSegmentType()=="organization"? $this->setSegment(new Organization()): $this->setSegment(new Department());
        $this->databaseManager = new DatabaseManager($this->getSegment());

        if($this->request->get("parent-id"))
        {
            $this->parentId = $this->request->get("parent-id");
        }

        if($this->request->getRequestType()=="index")
        {
            $this->setSegments($this->index());
        }
        else if($this->request->getRequestType()=="create"){
            $this->create();
        }
        else if($this->request->getRequestType()=="update"){
            $id = $this->request->get('id');
            $this->update($id);
        }
        else if($this->request->getRequestType()=="delete"){
            $id = $this->request->get('id');
            $this->delete($id);
        }
    }

    public function index()
    {
        $this->databaseManager->setConnection();
        if($this->request->get("parent-id"))
        {
            $parentType = $this->getSegmentType()=="department"?"Organization":"Department";
            $parentId = $this->request->get("parent-id");

            //find parent and set parent
            $parent = strcasecmp($parentType,"department")==0? new Department(): new Organization();
            $parentDbManager = new DatabaseManager($parent);
            $parentDbManager->setConnection();
            $this->parent = $parentDbManager->find($parentId);
            $parentDbManager->deleteConnection();

            return $this->databaseManager->getChildrenOfParent($parentType,$parentId);
        }
        else
        {
            $children = $this->databaseManager->findAll();
            $this->databaseManager->deleteConnection();
            return $children;
        }

    }

    public function create()
    {
        $segmentType = $this->request->get("create");
        $name_of_segment = $this->request->get($segmentType);
        $this->getSegment()->setName($name_of_segment);

        if($this->request->get("create")=="department")
        {
            $this->getSegment()->setParent($this->parentId);

            //Create department
            $this->databaseManager->setConnection();
            $this->databaseManager->create();
            $this->databaseManager->deleteConnection();

            //If children present then set them in department. Children is an array.
            if(!empty($this->request->get("participants")))
            {
                //Create all participants
                $participants = [];
                $lastId = $this->getSegment()->getChildren()==null ? 0: count($this->getSegment()->getChildren());
                foreach($this->request->get("participants") as $childName)
                {
                    $lastId++;
                    $participant = new Participant();
                    $participant->setName($childName);
                    $participant->setId($lastId);
                    $participant->setParent($this->getSegment()->getId());
                    array_push($participants,$participant);
                }
                $this->getSegment()->setChildren($participants);
            }

            //Update the parent organization
            $parentDatabaseManager = new DatabaseManager(new Organization());
            $parentDatabaseManager->setConnection();
            $parentOfDepartment = $parentDatabaseManager->find($this->parentId);

            //Add last_insert_id and do and update for the segment
            $this->getSegment()->setId($this->databaseManager->getLastInsertedId());
            $this->databaseManager->setConnection();
            $this->databaseManager->update($this->getSegment()->getId());
            $this->databaseManager->deleteConnection();

            if($parentOfDepartment->children==null)
                $parentOfDepartment->children = [$this->getSegment()];
            else
            {
                $childrenArray = unserialize($parentOfDepartment->children);
                array_push($childrenArray,$this->getSegment());
                $parentOfDepartment->children = $childrenArray;
            }
            $parentDatabaseManager->update($this->parentId);
            $parentDatabaseManager->deleteConnection();

            $this->redirect($this->getTemplateToRedirect());
        }
        else{
            $this->databaseManager->setConnection();
            $this->databaseManager->create();
            $this->databaseManager->deleteConnection();
            $this->redirect($this->getTemplateToRedirect());
        }
    }

    public function update($id)
    {
        if($this->request->get("update")=="organization")
        {
            $this->databaseManager->setConnection();
            $updatedName = $this->request->get("update-name");
            $this->getSegment()->setName($updatedName);
            $this->databaseManager->update($id);
            $this->databaseManager->deleteConnection();
            $this->redirect($this->getTemplateToRedirect());
        }
        else if($this->request->get("update")=="participant")
        {

        }
    }

    public function delete($id)
    {
        $this->databaseManager->setConnection();
        $this->databaseManager->delete($id);
        $this->databaseManager->deleteConnection();
        $this->redirect($this->getBaseTemplate());
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getManager()
    {
        return $this->databaseManager;
    }


    public function getTemplateToRedirect()
    {
        if(strcasecmp($this->getSegmentType(),"department")==0)
            $templateToRedirect= $this->getOrganizationTemplate().'?parent-id='.$this->parentId;
        else if(strcasecmp($this->getSegmentType(),"participant")==0)
            $templateToRedirect=$this->getDepartmentTemplate().'?parent-id='.$this->parentId;
        else
            $templateToRedirect= $this->getBaseTemplate();

        return $templateToRedirect;
    }
}