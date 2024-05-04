import { useApiUtilities } from "@/utilities/api"
import axios from "axios";

const { sendApiRequest } = useApiUtilities();

export const useHttpMessage = () => {
  
  const getAllChatRequest = () => {
    return sendApiRequest( async () => {
      return await axios.get('/api/chat');
    })
  }

  const sendNewTextMessageRequest = (formData) => {
    return sendApiRequest( async () => {
      return await axios.post('api/chat', formData);
    });
  }

  const getChatMessagesRequest = (chatId) => {
    return sendApiRequest( async () => {
      return await axios.get(`api/chat/${chatId}`);
    });
  }

  const sendTextMessageRequest = (formData) => {
    return sendApiRequest( async () => {
      return await axios.post('/api/message', formData); 
    })
  }

  const sendBlobMessageRequest = (formData) => {
    return sendApiRequest( async () => {
      return await axios.post('/api/message', formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      })
    })
  }

  return {
    getAllChatRequest,
    sendNewTextMessageRequest,
    getChatMessagesRequest,
    sendTextMessageRequest,
    sendBlobMessageRequest
  }
}