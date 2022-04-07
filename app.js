function putTodo(todo) {
    // implement your code here
    console.log("calling putTodo");
    console.log(todo);
}

function postTodo(todo) {
    // implement your code here
    fetch(window.location.href + 'api/todo',{method: 'POST',body: JSON.stringify(todo)})
    .then(response =>showToastMessage('Created Succesfully'))
    .catch(error => showToastMessage('Failed to create todos...'));
    
    // console.log("calling postTodo");
    // console.log(todo);
}

function deleteTodo(todo) {
    // implement your code here
    console.log("calling deleteTodo");
    console.log(todo);
}

// example using the FETCH API to do a GET request
function getTodos() {
    fetch(window.location.href + 'api/todo')
    .then(response => response.json())
    .then(json => drawTodos(json))
    .catch(error => showToastMessage('Failed to retrieve todos...'));
}

getTodos();