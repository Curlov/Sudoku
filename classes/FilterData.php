<?php
class FilterData
{
    /**
     * @var array
     */
    private array $data;
    /**
     * @var array
     */
    private array $array = [];
    /**
     * @var array
     */
    private array $views = [];
    /**
     * @param array $data
     */
    public function __construct(array $data) {
        $this->data = $data;
        $this->array = [];
        $this->views = [];

        $fields = ['view', 'area', 'action', 'username', 'id', 'country', 'password', 'submit', 'range', 'solutions', 'note', 'field', 'number'];

        foreach ($fields as $field) {
            if ($field === 'id') {
                $this->array[$field] = $data[$field] ?? 0;
            } elseif ($field === 'view') {
                $this->views[$field] = $data[$field] ?? (isset($_SESSION['username']) ? 'login' : 'main');
            } elseif ($field === 'area') {
                $this->views[$field] = $data[$field] ?? 'main';
            } elseif ($field === 'action') {
                $this->views[$field] = $data[$field] ?? 'showMain';
            } else {
                if (!empty($this->data[$field])) {
                    $this->array[$field] = $data[$field];
                }
            }
        }
    }
    /**
     * @return array
     */
    public function getArray(): array {
        return $this->array;
    }
    /**
     * @return array
     */
    public function getViews(): array
    {
        return $this->views;
    }

}