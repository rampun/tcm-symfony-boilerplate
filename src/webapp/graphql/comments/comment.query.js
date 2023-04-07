import { gql } from 'graphql-request'
import { CommentFragment } from '@/graphql/auth/comment.fragment'

export const CommentQuery = gql`
  query comment($id: String!) {
    comment(comment: { id: $id }) {
      ...CommentFragment
    }
  }
  ${CommentFragment}
`
