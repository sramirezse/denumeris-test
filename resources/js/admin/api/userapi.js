import axios from "../plugins/axios";


export default {
  async signin(params) {
    console.log('signin', params);
    const res = await axios.post(`/auth/loginAdmin`, params);
    console.log('this fortm', res)
    return res

  },
  async me() {
    return await axios.get('/auth/user')

  },
  async logout() {

    return await axios.post(`/auth/logout`);

  },
  async getUsers(payload) {
    const response = await axios.get('users/index', { params: payload });
    // console.log('getClients', response);
    return response;
  },
  async saveUser(payload) {
    const response = await axios.post('users/save', payload);
    // console.log('getClients', response);
    return response;
  }

}
