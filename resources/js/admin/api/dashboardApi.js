import axios from "../plugins/axios";


export default {
    async assertService(params) {
        return await axios.get(`/dashboard/assertService`, {params: params} );
    },
    async checkOrder(params) {
        return await axios.post(`/dashboard/checkOrder`,params);
    },
    async chartServices(params) {
        return await axios.get(`/dashboard/chartServices`,params);
    },
    async chartCars(params) {
        return await axios.get(`/dashboard/chartCars`,params);
    },
    async chartCompanies(params) {
        return await axios.get(`/dashboard/chartCompanies`,params);
    },

}
