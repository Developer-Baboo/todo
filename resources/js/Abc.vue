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
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ todo.name }}</td>
                                    <td>Delete</td>
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
            api: 'http://localhost:8000/api/todos',
            todo_input: ''
        };
    },
    mounted() {
        //get api data
        axios.get('http://localhost:8000/api/todos')
            .then(response => {
                this.todos.push(response.data);
                this.todo_input = '';
            })
            .catch(error => {
                console.error(error);
            });
    },
    methods: {
        saveTodo() {
            console.log(this.todo_input);
            if (this.todo_input.length > 0) {
                axios.post('http://localhost:8000/api/todosStore', { 'name': this.todo_input })
                    .then(response => {
                        console.log(response);
                        // Assuming the response contains the newly created todo object
                        this.todos.push(response.data); // Add the new todo to the todos array
                        this.todo_input = ''; // Clear the input field after successfully adding a new todo
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        }
    }

};
</script>
