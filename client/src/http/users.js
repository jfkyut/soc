import { useApiUtilities } from "@/utilities/api"
import axios from "axios";

const { sendApiRequest, getCsrfToken } = useApiUtilities();

export const useHttpUser = () => {

  const getUsers = () => {
    return sendApiRequest( async () => {
      return await axios.get('/api/users');
    })
  }

  return {
    getUsers
  }
}