<?php 
declare(strict_types=1);

namespace Form\Type;

use Form\GenericFormElement;

final class Textarea extends GenericFormElement
{
    public function render(): string
    {
        return sprintf(
            '<textarea name="%s" %s id="%s">%s</textarea>', 
            $this->getName(),
            $this->isRequired() ? 'required="required"' : '',
            $this->getId(),
            $this->getValue(),
        );
    }
}
