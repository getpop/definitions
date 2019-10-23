<?php
namespace PoP\Definitions\Definitions;

use PoP\Definitions\Settings\Environment;

abstract class AbstractDefinitionPersistence implements DefinitionPersistenceInterface
{
    protected $definitions = [];
    protected $names = [];
    protected $addedDefinition = false;
    protected $definition_resolver;
    protected $persisted_data;

    public function __construct()
    {
        // Comment Leo 03/11/2017: added a DB to avoid the website from producing errors each time that new templates are introduced
        // The DB is needed to return the same mangled results for the same incoming templates, over time
        // Otherwise, when a new module is introduced, the website after deploy will produce errors from
        // the cached data in the localStorage and Service Workers (the cached data references templates with a name that is not the right one anymore)
        // Get the database from the file saved in disk
        // The first time we generate the database, there will be nothing
        if ($this->persisted_data = $this->getPersistedData()) {
            $this->definitions = $this->persisted_data['database']['definitions'];
            $this->names = $this->persisted_data['database']['names'];
        }
    }

    public function setDefinitionResolver(DefinitionResolverInterface $definition_resolver): void
    {
        $this->definition_resolver = $definition_resolver;
        $this->definition_resolver->setPersistedData($this->persisted_data);
    }

    public function getDefinitionResolver()
    {
        return $this->definition_resolver;
    }

    public function getSavedDefinition($name, $group): ?string
    {
        if ($definition = $this->definitions[$group][$name]) {
            return $definition;
        }

        return null;
    }

    public function getOriginalName($definition, $group): ?string
    {
        if ($name = $this->names[$group][$definition]) {
            return $name;
        }

        return null;
    }

    public function saveDefinition($definition, $name, $group): void
    {
        $this->definitions[$group][$name] = $definition;
        $this->names[$group][$definition] = $name;

        // If that definition is not cached, it is a new one that will need to be saved
        $this->addedDefinition = true;
    }

    protected function getDatabase(): array
    {
        return [
            'definitions' => $this->definitions,
            'names' => $this->names,
        ];
    }

    protected function addedDefinition(): bool
    {
        return $this->addedDefinition;
    }

    public function storeDefinitionsPersistently(): void
    {
        if (Environment::disableDefinitionPersistence()) {
            return;
        }
        if ($this->addedDefinition()) {
            // Save the DB in the hard disk
            $data = array(
                'database' => $this->getDatabase(),
            );
            if ($resolver = $this->getDefinitionResolver()) {
                $data = array_merge(
                    $data,
                    $resolver->getDataToPersist()
                );
            }
            $this->persist($data);
        }
    }

    protected abstract function getPersistedData(): array;
    protected abstract function persist(array $data): void;
}
