<template>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">TODO</div>
                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" name="Todo .." class="form-control" id="" v-model="todo_input" >
                            <div class="input-group-append">
                                <button v-if="!edit_todo_id" class="btn btn-info text-white" @click="saveTodo()">Add</button>
                                <button v-else class="btn btn-warning text-white" @click="updateTodo()">Update</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm text-danger float-right" @click="resetTodo()">Reset</button>
                        <!-- {{ todos }} -->
                        <table class="table table-bordered mt-5" >
                            <thead>

                                <th>
                                    S.NO
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Action
                                </th>
                            </thead>
                           <tbody>
                                <tr v-for="(todo, index) in todos" :key="todo.id">
                                    <td>{{ todo.id}}</td>
                                    <td>{{ todo.name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger" @click="deleteTodo(todo.id)">Delete</button>
                                        <button type="button" class="btn btn-sm btn-info" @click="editTodo(todo.id)">Edit</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            todos: [],
            api: 'http://localhost:8000/api', // Remove '/todos' from the base URL
            todo_input: '',
            edit_todo_id: '',
            edit_index: '',
        };
    },
    mounted() {
        //get api data
        axios.get('http://localhost:8000/api/todos')
            .then(response => {
                this.todos = [...response.data]; // Spread the response data to add individual todos
                this.todo_input = '';
            })
            .catch(error => {
                console.error(error);
            });
    },
    methods: {
        // This method is triggered when the user clicks the "Save" button to add a new todo.
        saveTodo() {
            // Check if the input field is not empty
            if (this.todo_input.length > 0) {
                 // Send a POST request to the server to add a new todo with the entered name.
                axios.post('http://localhost:8000/api/todosStore', { 'name': this.todo_input })
                    .then(response => {
                         // Update the todos list with the response data from the server.
                        this.todos = response.data;
                        // Clear the input field after successfully adding a new todo.
                        this.todo_input = '';
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        },
        // This method is triggered when the user clicks the "Delete" button to remove a todo.
        deleteTodo(id) {
         // Find the index of the todo with the given id in the todos array.
            const index = this.todos.findIndex(todo => todo.id === id);
            // Check if the todo with the given id exists in the todos array.
            if (index !== -1) {
                // Send a DELETE request to the server to delete the todo with the given id.
                axios.delete(this.api + '/todos/' + id)
                    .then(res => {
                        // Remove the todo from the todos array using the index.
                        this.todos.splice(index, 1);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        },

        // This method is triggered when the user clicks the "Edit" button to modify a todo.
        editTodo(id) {
            // Find the index of the todo with the given id in the todos array.
            const index = this.todos.findIndex(todo => todo.id === id);
            // Check if the todo with the given id exists in the todos array
            if (index !== -1) {
                // Set the input field value to the name of the selected todo for editing.
                this.todo_input = this.todos[index].name;
                // Set edit_todo_id to the id of the selected todo for updating on the server.
                this.edit_todo_id = id;
                // Set edit_index to the index of the selected todo for reference during update.
                this.edit_index = index;
            }
        },

         // This method is triggered when the user clicks the "Update" button to save changes to a todo.
        updateTodo() {
            // Check if the input field is not empty and edit_todo_id is set (indicating an existing todo is being edited)
            // alert("Inside function");
            if (this.todo_input.length > 0 && this.edit_todo_id) {

                // alert("Inside If");
                // Prepare an object with id and name properties for the updated todo.
                const updatedTodo = {
                    id: this.edit_todo_id,
                    name: this.todo_input
                };
                axios.post('http://localhost:8000/api/todosUpdate', updatedTodo)
                    .then(response => {
                        // Assuming the response.data contains the updated todo item
                        const updatedTodoItem = response.data;
                        // Update the specific todo item in the todos array
                        this.todos = this.todos.map(todo => {
                            if (todo.id === updatedTodoItem.id) {
                                return updatedTodoItem;
                            }
                            return todo;
                        });
                        // Reset the input field and edit_todo_id after successful update
                        this.todo_input = '';
                        this.edit_todo_id = '';
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        },

       resetTodo() {
        this.todo_input = '';
        this.edit_todo_id = '';
        this.edit_index = '';
       }
    }

};
</script>
