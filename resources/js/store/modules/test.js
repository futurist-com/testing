import Axios from "axios"
//import Api from "../../api"

export default{
    state:{
     testList:null,
     curentTest:null, 
    },
    actions:{
        createTest({state, commit}, data){
            Axios.post('/api/tests/test', data)
            .then(resp=>{
                commit('updateCurrentTest', resp.data)
            }).catch(error=>{
                //модуль  message 
            })
        },
        getTestList({state, commit}){
            Axios.get('/api/test')
            .then(resp=>{
                commit('updateListTest', resp.data)
            })
        } 
    },
    mutations:{
        updateListTest(state, data){
            state.testList=data
        }
    },
    getters:{
        listTest(state){
            return state.testList
        }       
    }   
}