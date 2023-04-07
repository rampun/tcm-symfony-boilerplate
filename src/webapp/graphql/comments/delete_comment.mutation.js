import { gql } from 'graphql-request'

export const DeleteCommentMutation = gql`
  mutation deleteComment($id: String!) {
    deleteComment(comment: { id: $id })
  }
`
