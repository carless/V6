<?php
namespace Cesi\Core\libs\Controllers\Traits;

trait HeadingsAndTitle
{
    public $titles = [];
    public $headings = [];
    public $subheadings = [];

    // -----
    // TITLE
    // -----
    // What shows up in the browser tab

    /**
     * Get the title string for the current controller method (action).
     *
     * @param  bool $action   create / edit / reorder / etc
     * @return string
     */
    public function getTitle($action = false)
    {
        if (! $action) {
            $action = $this->getActionMethod();
        }

        if (isset($this->titles[$action])) {
            return $this->titles[$action];
        }
    }

    /**
     * Change the title of a page for a certain controller method (action).
     *
     * @param string $string string to use as title
     * @param string $action create / edit / reorder / etc
     */
    public function setTitle($string, $action = false)
    {
        if (! $action) {
            $action = $this->getActionMethod();
        }

        $this->titles[$action] = $string;
    }

    /**
     * Get the heading string for the current controller method (action).
     *
     * @param  bool $action   create / edit / reorder / etc
     * @return string
     */
    public function getHeading($action = false)
    {
        if (! $action) {
            $action = $this->getActionMethod();
        }

        if (isset($this->headings[$action])) {
            return $this->headings[$action];
        }
    }

    /**
     * Change the heading of a page for a certain controller method (action).
     *
     * @param string $string string to use as heading
     * @param string $action create / edit / reorder / etc
     */
    public function setHeading($string, $action = false)
    {
        if (! $action) {
            $action = $this->getActionMethod();
        }

        $this->headings[$action] = $string;
    }

    /**
     * Get the subheading for a certain controller method (action).
     *
     * @param  bool $action   create / edit / reorder / etc
     * @return string
     */
    public function getSubheading($action = false)
    {
        if (! $action) {
            $action = $this->getActionMethod();
        }

        if (isset($this->subheadings[$action])) {
            return $this->subheadings[$action];
        }
    }

    /**
     * Change the subheading of a page for a certain controller method (action).
     *
     * @param string $string string to use as subheading
     * @param string $action create / edit / reorder / etc
     */
    public function setSubheading($string, $action = false)
    {
        if (! $action) {
            $action = $this->getActionMethod();
        }

        $this->subheadings[$action] = $string;
    }
}