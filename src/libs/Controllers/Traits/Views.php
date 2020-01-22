<?php
namespace Cesi\Core\libs\Controllers\Traits;

trait Views
{
    protected $listView     = 'cesi::crud.list';
    protected $editView     = 'cesi::crud.edit';
    protected $editModalView= 'cesi::crud.editmodal';
    protected $createView   = 'cesi::crud.create';
    protected $createModalView= 'cesi::crud.createmodal';

    protected $listContentClass;
    protected $editContentClass;
    protected $createContentClass;

    // -------
    // READ
    // -------

    /**
     * Sets the list template.
     * @param string $view name of the template file
     * @return string $view name of the template file
     */
    public function setListView($view)
    {
        $this->listView = $view;
        return $this->listView;
    }

    /**
     * Gets the list template.
     * @return string name of the template file
     */
    public function getListView()
    {
        return $this->listView;
    }

    /**
     * Sets the list content class.
     * @param string $listContentClass content class
     */
    public function setListContentClass(string $listContentClass)
    {
        $this->listContentClass = $listContentClass;
    }

    /**
     * Gets the list content class.
     * @return string content class for list view
     */
    public function getListContentClass()
    {
        return $this->listContentClass ?? config('cesi.core.crud.list_content_class', 'col-12');
    }

    // -------
    // CREATE
    // -------

    /**
     * Sets the create template.
     *
     * @param string $view name of the template file
     *
     * @return string $view name of the template file
     */
    public function setCreateView($view)
    {
        $this->createView = $view;
        return $this->createView;
    }

    /**
     * Gets the create template.
     * @return string name of the template file
     */
    public function getCreateView()
    {
        return $this->createView;
    }

    /**
     * Sets the create template.
     *
     * @param string $view name of the template file
     *
     * @return string $view name of the template file
     */
    public function setCreateModalView($view)
    {
        $this->createModalView = $view;
        return $this->createModalView;
    }

    /**
     * Gets the create template.
     * @return string name of the template file
     */
    public function getCreateModalView()
    {
        return $this->createModalView;
    }

    /**
     * Sets the create content class.
     * @param string $createContentClass content class
     */
    public function setCreateContentClass(string $createContentClass)
    {
        $this->createContentClass = $createContentClass;
    }

    /**
     * Gets the create content class.
     * @return string content class for create view
     */
    public function getCreateContentClass()
    {
        return $this->createContentClass ?? config('cesi.core.crud.list_content_class', 'col-12');
    }

    // -------
    // UPDATE
    // -------

    /**
     * Sets the edit template.
     *
     * @param string $view name of the template file
     *
     * @return string $view name of the template file
     */
    public function setEditView($view)
    {
        $this->editView = $view;
        return $this->editView;
    }

    /**
     * Gets the edit template.
     * @return string name of the template file
     */
    public function getEditView()
    {
        return $this->editView;
    }

    /**
     * Sets the edit content class.
     * @param string $editContentClass content class
     */
    public function setEditContentClass(string $editContentClass)
    {
        $this->editContentClass = $editContentClass;
    }

    /**
     * Gets the edit content class.
     * @return string content class for edit view
     */
    public function getEditContentClass()
    {
        return $this->editContentClass ?? config('cesi.core.crud.edit_content_class', 'col-12');
    }

    /**
     * Sets the edit template.
     *
     * @param string $view name of the template file
     *
     * @return string $view name of the template file
     */
    public function setEditModalView($view)
    {
        $this->editModalView = $view;
        return $this->editModalView;
    }

    /**
     * Gets the edit template.
     * @return string name of the template file
     */
    public function getEditModalView()
    {
        return $this->editModalView;
    }
}
