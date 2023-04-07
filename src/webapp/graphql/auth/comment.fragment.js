import { gql } from 'graphql-request'

export const CommentFragment = gql`
  fragment CommentFragment on Comment {
    id
    text
  }
`
