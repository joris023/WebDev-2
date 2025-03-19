import axios from 'axios';

const token = localStorage.getItem('jwt');

const instance = axios.create({
    baseURL: 'http://localhost/',
    headers: token ? { Authorization: `Bearer ${token}` } : {}
});

export default instance;
