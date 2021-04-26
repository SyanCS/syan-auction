import APIService from '@/services/APIService.js'

const backend_controller = '/auto-bids-items/'
export default {
  save (itemId) {
    return APIService.apiCall().get(backend_controller+'save/'+itemId+'.json')
  },
  delete (itemId) {
    return APIService.apiCall().delete(backend_controller+'delete/'+itemId+'.json')
  },
  getLoggedUserItemAutoBid(itemId) {
    return APIService.apiCall().get(backend_controller+'get-logged-user-item-auto-bid/'+itemId+'.json')
  }
}
