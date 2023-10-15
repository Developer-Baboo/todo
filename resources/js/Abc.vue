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
                                <button class="btn btn-info text-white" @click="saveTodo()">Add</button>
                            </div>
                        </div>
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
                                    <td>{{ index}}</td>
                                    <td>{{ todo.name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger" @click="deleteTodo(index)">Delete</button>
                                        <button type="button" class="btn btn-sm btn-info" @click="editTodo(index)">Edit</button>
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
            todo_input: ''
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
        saveTodo() {
            if (this.todo_input.length > 0) {
                axios.post('http://localhost:8000/api/todosStore', { 'name': this.todo_input })
                    .then(response => {
                        this.todos = response.data; // Update the todos list with the entire response data
                        this.todo_input = ''; // Clear the input field after successfully adding a new todo
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        },
       deleteTodo(index) {
            if (this.todos[index].id) {
                axios.delete(this.api + '/todos/' + this.todos[index].id)
                    .then(res => {
                        this.todos.splice(index, 1);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
       },

       editTodo(index) {

       }


    }

};
</script>
