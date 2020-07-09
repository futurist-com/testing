import Axios from "axios"
//import Api from "../../api"

export default{
    state:{
       currentCompanyId:null,
       currentCompany:{}
    },
    actions:{
        setCurrentCompanyId({context}, companyId){
           context.commit('updateCurrentCompanyId', companyId)     
        },
        getCurrentCompany(context, companyId){
            api
            .call("get", "/api/get-company/" + companyId)
            .then(resp => {
              
                context.commit('updateCurrentCompany', resp.data.company);
            })
            .catch(response => {
            });
        }
    },
    mutations:{
        updateCurrentCompanyId(state, companyId){
            state.currentCompanyId=companyId
        },
        updateCurrentCompany(state, company){
            state.currentCompany=company
        }
    },
    getters:{
        currentCompanyId(state){
            return state.currentCompanyId
        }, 
        currentCompany(state){
            return state.currentCompany
        }
    }   
}