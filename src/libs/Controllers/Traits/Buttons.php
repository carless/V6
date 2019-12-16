<?php
namespace Cesi\Core\libs\Controllers\Traits;

use Illuminate\Support\Collection;

trait Buttons
{
    public $buttons;

    /**
     * Inicializa los buttons de las acciones
     *
     * pueden ser :
     * 'line'   : En linea
     * 'top'    : En la parte superior
     */
    public function initButtons()
    {
        $this->buttons = collect();

        if ($this->tienePermiso('update')) {
            $this->addButton('line', 'update', 'view', 'cesi::crud.buttons.update', 'end');
        }
        if ($this->tienePermiso('delete')) {
            $this->addButton('line', 'delete', 'view', 'cesi::crud.buttons.delete', 'end');
        }

        if ($this->tienePermiso('create')) {
            $this->addButton('top', 'create', 'view', 'cesi::crud.buttons.create', 'end');
        }

        $this->addButton('top', 'refresh', 'view', 'cesi::crud.buttons.refresh', 'end');
    }

    /**
     * @return Collection
     */
    public function getButtons()
    {
        return $this->buttons;
    }

    /**
     * Add a button to the CRUD table view.
     *
     * @param string      $stack           Where should the button be visible? Options: top, line, bottom.
     * @param string      $name            The name of the button. Unique.
     * @param string      $type            Type of button: view or model_function.
     * @param string      $content         The HTML for the button.
     * @param bool|string $position        Position on the stack: beginning or end. If false, the position will be
     *                                     'beginning' for the line stack or 'end' otherwise.
     * @param bool        $replaceExisting True if a button with the same name on the given stack should be replaced.
     *
     * @return MyCrudButton The new CRUD button.
     */
    public function addButton($stack, $name, $type, $content, $position = false, $replaceExisting = true)
    {

        if ($position == false) {
            switch ($stack) {
                case 'line':
                    $position = 'beginning';
                    break;

                default:
                    $position = 'end';
                    break;
            }
        }

        if ($replaceExisting) {
            $this->removeButton($name, $stack);
        }

        $button = new MyCrudButton($stack, $name, $type, $content);
        switch ($position) {
            case 'beginning':
                $this->buttons->prepend($button);
                break;

            default:
                $this->buttons->push($button);
                break;
        }

        return $button;
    }

    /**
     * Remove a button from the CRUD panel.
     *
     * @param string $name  Button name.
     * @param string $stack Optional stack name.
     */
    public function removeButton($name, $stack = null)
    {
        $this->buttons = $this->buttons->reject(function ($button) use ($name, $stack) {
            return $stack == null ? $button->name == $name : ($button->stack == $stack) && ($button->name == $name);
        });
    }

    public function removeAllButtons()
    {
        $this->buttons = collect([]);
    }

    public function removeAllButtonsFromStack($stack)
    {
        $this->buttons = $this->buttons->reject(function ($button) use ($stack) {
            return $button->stack == $stack;
        });
    }

    public function removeButtonFromStack($name, $stack)
    {
        $this->buttons = $this->buttons->reject(function ($button) use ($name, $stack) {
            return $button->name == $name && $button->stack == $stack;
        });
    }
}

class MyCrudButton
{
    public $stack;
    public $name;
    public $type = 'view';
    public $content;

    public function __construct($stack, $name, $type, $content)
    {
        $this->stack = $stack;
        $this->name = $name;
        $this->type = $type;
        $this->content = $content;
    }
}