import { useApiUtilities } from "@/utilities/api"
import axios from "axios";

const { sendApiRequest, getCsrfToken } = useApiUtilities();

export const useHttpMessage = () => {
  
  const sendNewTextMessage = (formData) => {
    return sendApiRequest( async () => {
      return await axios.post('api/chat', formData);
    });
  }

  return {
    sendNewTextMessage
  }
}