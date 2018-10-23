|Item
|----
|- id : int
|- name : string
|- completed : bool
|- deadline : string
|<br>
|+ getId() : int
|+ setId(int $id)
|+ getName() : string
|+ setName(string $name)
|+ getDeadline() : string
|+ setDeadline(int $deadline)
|+ getCompleted() : bool
|+ setCompleted(bool $completed)

|ItemInterface
|---
|+ getId() : int
|+ setId(int $id)
|+ getName() : string
|+ setName(string $name)
|+ getDeadline() : string
|+ setDeadline(int $deadline)
|+ getCompleted() : bool
|+ setCompleted(bool $completed)

|ItemTable
|----
|- connection
|<br>
|+ __construct($host, $dbName, $username, $password)
|+ insert($name, $deadline)
|+ fetch($id)
|+ fetchId($id)
|+ findAllNotCompletedItems()
|+ updateItemCompleted($id, $completed)
|+ editItem($id, $name, $deadline)
|+ sortAllItems($completed)
|+ sortAllItemsD($completed)
|+ findAllItems()

|ItemTableInterface
|----
|+ insert($name, $deadline)
|+ fetch($id)
|+ fetchId($id)
|+ findAllNotCompletedItems()
|+ updateItemCompleted($id, $completed)
|+ editItem($id, $name, $deadline)
|+ sortAllItems($completed)
|+ sortAllItemsD($completed)
|+ findAllItems()

|ItemRepository
|----
|- table
|<br>
|+ __construct(ItemTableInterface $itemTable)
|+ save(ItemInterface $item)
|+ edit(ItemInterface $item)
|+ markCompleted(ItemInterface $item)
|+ getById($id)
|+ findAll()

|ItemRepositoryInterface
|----
|+ save(ItemInterface $item)
|+ edit(ItemInterface $item)
|+ markCompleted(ItemInterface $item)
|+ getById($id)
|+ findAll()

|Validator
|----
|
|<br>
|+ checkLength($name)
|+ isRealDate($date)
|+ checkIfPast($date)
|+ checkNamePattern($name)

|ValidatorInterface
|----
|+ checkLength($name)
|+ isRealDate($date)
|+ checkIfPast($date)
|+ checkNamePattern($name)

