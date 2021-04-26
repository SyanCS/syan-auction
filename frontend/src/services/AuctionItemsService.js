import APIService from '@/services/APIService.js'

const backend_controller = '/auction-items/'
export default {
  getAllItems () {
    return APIService.apiCall().get(backend_controller)
  },
  getItem (id) {
    return APIService.apiCall().get(backend_controller+'view/'+id+'.json')
  },
  deleteItem(id) {
    return APIService.apiCall().delete(backend_controller+'delete/'+id+'.json')
  }
}
