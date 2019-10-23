<?php
namespace PoP\Definitions\Definitions;

use PoP\Hooks\Contracts\HooksAPIInterface;

class DefinitionManager implements DefinitionManagerInterface
{
    protected $names = [];
    protected $name_definitions = [];
    protected $definition_names = [];
    protected $definition_resolver;
    protected $definition_persistence;

    protected $hooksAPI;

    function __construct(
        HooksAPIInterface $hooksAPI
    ) {
        $this->hooksAPI = $hooksAPI;
    }

    public function getDefinitionResolver(): ?DefinitionResolverInterface
    {
        return $this->definition_resolver;
    }
    public function setDefinitionResolver(DefinitionResolverInterface $definition_resolver): void
    {
        $this->definition_resolver = $definition_resolver;

        // Allow the Resolver and the Persistence to talk to each other
        if ($this->definition_persistence) {
            $this->definition_persistence->setDefinitionResolver($this->definition_resolver);
        }
    }
    public function setDefinitionPersistence(DefinitionPersistenceInterface $definition_persistence): void
    {
        $this->definition_persistence = $definition_persistence;

        // Allow the Resolver and the Persistence to talk to each other
        if ($this->definition_resolver) {
            $this->definition_persistence->setDefinitionResolver($this->definition_resolver);
        }
    }

    protected function mirrorName($group): bool
    {
        $keepname_groups = (array)$this->hooksAPI->applyFilters(
            'DefinitionManager:keep-name:groups',
            [
                POP_DEFINITIONGROUP_ROUTES,
            ]
        );

        // Fix this!!! Temporary fix because Utils is not found (in PoP Engine!)
        // return !Utils::isMangled() || in_array($group, $keepname_groups);
        return in_array($group, $keepname_groups);
    }

    /**
     * Make sure the name has not been defined already. If it has, throw an Exception
     */
    public function getUniqueDefinition($name, $group): string
    {
        // If the ID has already been defined, then throw an Exception
        $this->names[$group] = $this->names[$group] ?? array();
        if (in_array($name, $this->names[$group])) {
            throw new \Exception(sprintf('Error with the Defining: another constant/object was already registered with name \'%s\' and group \'%s\'', $name, $group));
        }
        $this->names[$group][] = $name;

        // Simply return the definition
        return $this->getDefinition($name, $group);
    }

    /**
     * Function used to create a definition for a module. Needed for reducing the filesize of the html generated for PROD
     * Instead of using the name of the $module, we use a unique number in base 36, so the name will occupy much lower size
     * Comment Leo 27/09/2017: Changed from $module to only $id so that it can also be used with ResourceLoaders
     */
    public function getDefinition($name, $group): string
    {
        if ($definition = $this->name_definitions[$group][$name]) {
            return $definition;
        }

        // Mirror: it simply returns the $module again. It confirms in the code that this decision is deliberate
        // (not calling function getDefinition could also be that the developer forgot about it)
        // It is simply used to explicitly say that we need the same name as the module, eg: for the filtercomponents,
        // so that in the URL params it shows names that make sense (author=...&search=...)
        // If not mangled, then that's it, use the original $module, do not allow plugins to provide a different value
        if ($this->mirrorName($group)) {
            return $name;
        }

        // Allow the persistence layer to return the value directly
        if ($this->definition_persistence) {
            if ($definition = $this->definition_persistence->getSavedDefinition($name, $group)) {
                $this->definition_names[$group][$definition] = $name;
                $this->name_definitions[$group][$name] = $definition;
                return $definition;
            }
        }

        // Allow the injected Resolver to decide how the name is resolved
        if ($this->definition_resolver) {
            $definition = $this->definition_resolver->getDefinition($name, $group);
            if ($definition != $name && $this->definition_persistence) {
                $this->definition_persistence->saveDefinition($definition, $name, $group);
            }
            $this->definition_names[$group][$definition] = $name;
            $this->name_definitions[$group][$name] = $definition;
            return $definition;
        }

        return $name;
    }

    /**
     * Given a definition, retrieve its original name
     */
    public function getOriginalName($definition, $group): string
    {
        // If it is cached in this object, return it already
        if (isset($this->definition_names[$group][$definition])) {
            return $this->definition_names[$group][$definition];
        }

        // Otherwise, ask if the persistence object has it
        if ($this->definition_persistence) {
            if ($name = $this->definition_persistence->getOriginalName($definition, $group)) {
                $this->definition_names[$group][$definition] = $name;
                $this->name_definitions[$group][$name] = $definition;
                return $name;
            }
        }

        // It didn't find it, assume it's the same
        return $definition;
    }
}
